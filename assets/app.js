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

    function addCategory() {
        console.log(imgCollectionHolder.dataset.prototype)
        let dataPrototype =  imgCollectionHolder.dataset.prototype
        dataPrototype.replace(/__name__/g, indexCategory)
        imgCollectionHolder.innerHTML += dataPrototype
        indexCategory++
        console.log(indexCategory)

    }
        let newImgBtn = document.querySelector("#new_image")
        newImgBtn.addEventListener('click',addCategory)