// Declaration of variables
let section = document.querySelector("#images");

//Change header
document.querySelector("h1").innerHTML = desc;

//Function to assemble the image
function assembly(arrImg) {
    //Create table and append to images section
    document.querySelector("#images").innerHTML = '<table class="noSpace members-order-img"><tbody></tbody></table>';
    
    let rows = 4;
    let cols = 5;
    let imageIndex = 0;
  
    //Create rows
    for (let r = 1; r < rows + 1; r++) {
        document.querySelector("tbody").innerHTML += `<tr class="noSpace" id="r${r}"></tr>`;

        //Create columns for each row
        for (let c = 1; c < cols + 1; c++) {
            document.querySelector(`#r${r}`).innerHTML += `<td class="noSpace" id="r${r}c${c}"></td>`;
            //Append images to cells of the table
            document.querySelector(`#r${r}c${c}`).appendChild(arrImg[imageIndex]);

            imageIndex++;
        }
    }
}

assembly(PreloadedImages);