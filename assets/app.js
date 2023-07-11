/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

let imgCollectionHolder = document.querySelector('#car_image_collection')

    let indexCategory = imgCollectionHolder.querySelectorAll("car_category___name__").length

    
    
    function addImage() {
        //récupère les attributs à l'intérieur de la div
        // ImgCollectionHolder et remplace l'index [__name__]
        // par indexCategory 
        let dataPrototype =  imgCollectionHolder.dataset.prototype.replace(/__name__/g, indexCategory);
        
        console.log(dataPrototype);
        // ajoute un nouveau champ image 
        // à partir du contenu de la div (dataPrototype)
        imgCollectionHolder.innerHTML += dataPrototype;
        
        AddDeleteBtn()

        indexCategory++;

        console.log(indexCategory);
        
    }

    function AddDeleteBtn() {
        
        let btnDelete = document.createElement("button")
        btnDelete.classList.add('btn', 'btn-delete')
        btnDelete.setAttribute('type','button')
        btnDelete.innerHTML = "Supprimer"
        
        let subFormId = "#car_image_collection_"+ indexCategory.toString()
        //On sélectionne le wrapper puis le nouveau formulaire auquel
        //on ajoute le bouton supprimer
        let subForm = document.querySelector(`${subFormId}`).querySelector("div")
        subForm.appendChild(btnDelete)
    }

    // function deleteForm(params) {
        
    // }


        let newImgBtn = document.querySelector("#new_image")
        newImgBtn.addEventListener('click',addImage)

        

