'use strict';

const timeGap = (time) => {
	const now = new Date();
	const serverTime = new Date(time);
	const gap = serverTime - now;
	return gap;
}

const countdown = (gap) => {
	const now = new Date().getTime() + gap;
	endtime = new Date(endtime).getTime();
	const remainMiliSec = Math.max(0,endtime - now);
	const sec = Math.floor(remainMiliSec / 1000) % 60;
	const min = Math.floor(remainMiliSec / 1000 / 60) % 60;
	const hour = Math.floor(remainMiliSec / 1000 / 60 / 60) % 24;
	const day = Math.floor(remainMiliSec / 1000 / 60 / 60 / 24);

	const element = document.getElementById('countdown');
	element.textContent = `残り${day}日${hour}時間${min}分${sec}秒です`;
	if (remainMiliSec > 0){
		setTimeout(() => {countdown(gap)},1000);
	}
}

const url = 'http://localhost:10080';

fetch(url)
	.then(res => {
		const time = new Date(res.headers.get('Date'));
		const gap = timeGap(time);
		countdown(gap);
	})
	.catch(err => {
		console.log(err);
	});

