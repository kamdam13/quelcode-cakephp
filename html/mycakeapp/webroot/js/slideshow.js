'use strict';
let index = 0;
const arrSize = image_files.length; 
const img = document.getElementById('biditemimage');
img.onclick = () => {
	index += 1;
	index %= arrSize;
	img.src = `/img/biditemImages/${image_files[index]['biditem_id']}/${image_files[index]['image_file_name']}`;
} 
