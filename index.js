window.addEventListener('load', function() {
    "use strict"

    let main_text = this.document.getElementById('recipe_full');

    let clickables = this.document.querySelectorAll('li.recipe-list-item');
    clickables.forEach(element => {
        element.addEventListener('click', () => {
            displayRecipe(element.id)
        })
    });
    clickables = this.document.querySelectorAll('div.recipe-scroll-item');
    clickables.forEach(element => {
        element.addEventListener('click', () => {
            displayRecipe(element.id)
        })
    });




    //I realised that the best option for this functionality is to 
    //use API call. However due to time constraints, i decided to use 
    //my old API server located at newnumyspace.co.uk given to me by
    //Northumbria University for the purpose of CS Course
    async function displayRecipe(id){

        
        const response = await fetch("http://unn-w20020557.newnumyspace.co.uk/API/directions/" + id)
        .then((result) => 
            result.json()
        )
        .then((result) => {
            console.log(result);
            let directions = globalThis.document.getElementById('directions')
            directions.innerHTML = ''
            result['directions'].forEach(element => {
                console.log(element.direction)
                directions.innerHTML+= '<li class="recipe-full-directions">' +
                 element.direction + 
                 '</li>' 
            });
        })
    }
})