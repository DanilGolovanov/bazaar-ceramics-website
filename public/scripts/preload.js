//Split url 
var arr = window.location.href.split('?');

//Get last value 
var info = arr[arr.length -1];

//separate info (productID, product desc, price)
info = info.split('/');

let productID = info[0];

//Removing '%20' in the description
let temporary = info[1].split('%20');
temporary = temporary.join(' ');

let desc = temporary;
let price = info[2];

//Link
let link = '/bazaar_ceramics_ss/public/images/products/' + productID + '/';

//Preload Images
function preloadImages()
{
    let rows = 4;
    let cols = 5;
    let images = new Array();

    for (let r = 1; r < rows + 1; r++) {
        for (let c = 1; c < cols + 1; c++) {
            let img = `${link}row-${r}-col-${c}.jpg`;
            images.push(img);
        }
    }

    return preload(images);
}

function preload(arrImgLinks) {
    let arrImg = new Array();

    for (let i = 0; i < arrImgLinks.length; i++) {
        arrImg[i] = new Image();
        arrImg[i].src = arrImgLinks[i];
    }

    return arrImg;
}

var PreloadedImages = preloadImages();