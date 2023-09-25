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
            
            //Fill the title of the recipe
            let title = globalThis.document.getElementById('title')
            title.innerHTML = result['title']

            //Fill the description of the recipe
            let description = globalThis.document.getElementById('description')
            description.innerHTML = result['description']

            //Show author, preperation and cooking time if present
            let subtitle = globalThis.document.getElementById('subtitle')
            subtitle.innerHTML = ''
            subtitle.innerHTML = "By: " + result['author'] + 
            ((result['prep_time_min'] == null) ? '' : (" | prep time: " + result['prep_time_min']) )+ 
            ((result['cook_time_min'] == null) ? ('') : (" | cook time: " + result['cook_time_min']))

            let ingridients = globalThis.document.getElementById('ingridients')
            ingridients.innerHTML = ''
            result['ingridients'].forEach(element => {
                console.log(element.direction)
                ingridients.innerHTML+= '<li class="recipe-full-ingridients">' +
                 element.name +
                 ((element.quantity == null)? ('') : (', ' + element.quantity)) + 
                 ((element.units == null) ? ('') : (' ' + element.units)) +  
                 '</li>' 
            });

            let image = globalThis.document.getElementById('image')
            image.src = result['image']
            
            let directions = globalThis.document.getElementById('directions')
            directions.innerHTML = ''
            result['directions'].forEach(element => {
                console.log(element.direction)
                directions.innerHTML+= '<div class="recipe-full-directions"> - ' +
                 element.direction + 
                 '</div>' 
            });
        })
    }
})