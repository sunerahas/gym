


function un_popup(){
    document.getElementById('expore-wrapper').style.display="none";
}




function open_popup(name_of_gym,trainer_name,trainer_colifi,packege_month,packege_half_year,packege_year,equpName,area_name) {
   // document.getElementById("equip_display_box").innerHTML = "";

    document.getElementById('expore-wrapper').style.display="block";

    document.getElementById('name-of-gym').innerText = name_of_gym;
    document.getElementById('trainer-name').innerText = trainer_name;
    document.getElementById('trainer-colifi').innerText = trainer_colifi;
    document.getElementById('packege-month').innerText = packege_month;
    document.getElementById('packege-half-year').innerText = packege_half_year;
    document.getElementById('packege-year').innerText = packege_year;

    let equpNamearr = equpName.split(",");
    //console.log(equpNamearr);
    let image_block ="";
    equpNamearr.pop();


    equpNamearr.forEach((item,index) => {

        let equipName = item;
      
        equipName = removeWordAndHyphen(item, area_name , name_of_gym)
        
        image_block += `
        
        <div class="col-3">
            <img src="./Images/gym-equp/${item}" alt="gym equipments image" width="100%" height ="200px">
            <p class="equipment-name fw-bold text-center">${equipName}</p>
        </div>
        
        `;
    });

    document.getElementById("equip_display_box").innerHTML = image_block;

}

function removeWordAndHyphen(str, word,name_of_gym) {
    // Remove the specified word from the string
    str = str.replace(word, '');
  
    // Remove the first "-" symbol from the string
    str = str.replace('-', '');

    str = str.replace('.png', '');

    str = str.replace(name_of_gym.replace(/\s/g, ''), '');
    str = str.replace('-', '');
  
    return str;
  }