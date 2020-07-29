<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event; // added.

/**
 * Ratings Controller
 *
 * @property \App\Model\Table\RatingsTable $Ratings
 *
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatingsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Biditems');
        $this->loadModel('Ratings');
		$this->loadModel('Bidinfo');
        // 各種コンポーネントのロード
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout',
            ],
            'authError' => 'ログインしてください。',
        ]);
    }

    // ログイン処理
    function login()
    {
        // POST時の処理
        if ($this->request->isPost()) {
            $user = $this->Auth->identify();
            // Authのidentifyをユーザーに設定
            if (!empty($user)) {
                $this->Auth->setUser($user);
                // return $this->redirect($this->Auth->redirectUrl());
                return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
            }
            $this->Flash->error('ユーザー名かパスワードが間違っています。');
        }
    }

    // ログアウト処理
    public function logout()
    {
        // セッションを破棄
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    // 認証を使わないページの設定
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([]);
    }

    // 認証時のロールのチェック
    public function isAuthorized($user = null)
    {
        // 管理者はtrue
        if ($user['role'] === 'admin') {
            return true;
        }
        // 一般ユーザーはfalse
        if ($user['role'] === 'user') {
            if($this->request->action === 'add'){
                return true;
            }else{
                return false;
            }
        }
        // 他はすべてfalse
        return false;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $ratings = $this->paginate($this->Ratings);

        $this->set(compact('ratings'));
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rating = $this->Ratings->get($id, [
            'contain' => ['RatedUsers', 'RatedByUsers'],
        ]);

        $this->set('rating', $rating);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($bidinfo_id = null)
    {
        $rating = $this->Ratings->newEntity();
        if ($this->request->is('post')) {
            $bidinfo = $this->Bidinfo->get($bidinfo_id,[
                'contain' => ['Users','Biditems','Biditems.Users',]
            ]);
    
            $reciever_id = $bidinfo->user_id;
            $shipper_id = $bidinfo->biditem->user_id;
            // アクセス制御
            if(!isset($bidinfo) || !in_array($this->Auth->user('id'),[$reciever_id,$shipper_id])){
                return $this->redirect(['controller' => 'auction','action' => 'index']);
            }
            if($this->Auth->user('id') === $reciever_id){
                $bidinfo->is_rated_by_reciever = true;
            }
            if($this->Auth->user('id') === $shipper_id){
                $bidinfo->is_rated_by_shipper = true;
            }

            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating) && $this->Bidinfo->save($bidinfo)) {
                $this->Flash->success(__('The rating has been saved.'));

            }else{
                $this->Flash->error(__('The rating could not be saved. Please, try again.'));
            }
            return $this->redirect(['controller' => 'auction','action' => 'transaction',$bidinfo_id]);
        }else{
            return $this->redirect(['controller' => 'auction','action' => 'index']);
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rating = $this->Ratings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $ratedUsers = $this->Ratings->RatedUsers->find('list', ['limit' => 200]);
        $ratedByUsers = $this->Ratings->RatedByUsers->find('list', ['limit' => 200]);
        $this->set(compact('rating', 'ratedUsers', 'ratedByUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rating = $this->Ratings->get($id);
        if ($this->Ratings->delete($rating)) {
            $this->Flash->success(__('The rating has been deleted.'));
        } else {
            $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
