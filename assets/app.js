/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// let imgCollectionHolder = document.querySelector('#car_image_collection')

//     let imgSubFormIndex = imgCollectionHolder.querySelectorAll("car_category___name__").length

//     class Form{
//         constructor(subForm,deleteBtn){
//             this.subForm = subForm;
//             this.deleteBtn = deleteBtn
            
//         }
//     }
//     let formArray = []

//     function addImage() {
//         // récupère les attributs à l'intérieur de la div
//         // ImgCollectionHolder et remplace l'index [__name__]
//         // par imgSubFormIndex 
//         let dataPrototype =  imgCollectionHolder.dataset.prototype.replace(/__name__/g, imgSubFormIndex);
        
//         // console.log(dataPrototype);
//         // ajoute un nouveau champ image 
//         // à partir du contenu de la div (dataPrototype)
//         imgCollectionHolder.innerHTML += dataPrototype;
        
//         let deleteBtn = document.createElement("button")
//         deleteBtn.classList.add('btn', 'btn-delete')
//         deleteBtn.setAttribute('type','button')
//         deleteBtn.innerHTML = "Supprimer"
        
//         let subFormId = "#car_image_collection_"+ imgSubFormIndex.toString()
//         //On sélectionne le wrapper puis le nouveau formulaire auquel
//         //on ajoute le bouton supprimer
//         let subForm = document.querySelector(`${subFormId}`).querySelector("div")
//         subForm.appendChild(deleteBtn)
                
//         let form = new Form(subForm,deleteBtn)
        
//         let pushedForm = Object.create(form)
//         formArray.push(pushedForm)
//         // console.log(form);
//         formArray[imgSubFormIndex].deleteBtn.addEventListener('click',()=>{
//             form.subForm.remove()
//         })

//         imgSubFormIndex++;
//     }


        
  

//         let newImgBtn = document.querySelector("#new_image")
//         newImgBtn.addEventListener('click',addImage)


