window.addEventListener('load', function() {
    "use strict"

    //"clickables" refers to items that upon pressing are meant to display full recipe
    //First all items on left side list are added an event litener
    let clickables = this.document.querySelectorAll('li.recipe-list-item');
    clickables.forEach(element => {
        element.addEventListener('click', () => {
            displayRecipe(element.id)
        })
    })
    
    //Then all items on right scrolling track are added an event listener
    clickables = this.document.querySelectorAll('div.recipe-scroll-item');
    clickables.forEach(element => {
        element.addEventListener('click', () => {
            displayRecipe(element.id)
        })
    });

    //displayRecipe(id) fetches all important attributes of the recipe and displays them
    //in the main area of the screen
    async function displayRecipe(id){  

        /**
         * I realised that the best option for this functionality is to 
         * use API call. However due to time constraints, i decided to use 
         * my old API server located at newnumyspace.co.uk given to me by
         * Northumbria University for the purpose of CS Course
         * This realisation occured only on second day of working on the website,
         * which is why some other areas that could benefit from working API
         * are not using it anyway. There was not time to change already built stuff
         */

        //request all information to a recipe of given id
        const response = await fetch("http://unn-w20020557.newnumyspace.co.uk/API/directions/" + id)
        .then((result) => 
        //converst results to json
            result.json()
        )
        .then((result) => {
            
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

            //Show ingridients, quantity and units if present
            let ingridients = globalThis.document.getElementById('ingridients')
            ingridients.innerHTML = ''

                //add each ingridient to the list
            result['ingridients'].forEach(element => {
                ingridients.innerHTML+= '<li class="recipe-full-ingridients">' +
                 element.name +
                 ((element.quantity == null)? ('') : (', ' + element.quantity)) + 
                 ((element.units == null) ? ('') : (' ' + element.units)) +  
                 '</li>' 
            });

            //Show image and change the source to supplied by the fetch
            let image = globalThis.document.getElementById('image')
            image.src = result['image']
            image.hidden = false
            
            //Display directions of the recipe
            let directions = globalThis.document.getElementById('directions')
            directions.innerHTML = ''

                //add each direction to the list with proper formatting
            result['directions'].forEach(element => {
                console.log(element.direction)
                directions.innerHTML+= '<div class="recipe-full-directions"> - ' +
                 element.direction + 
                 '</div>' 
            });
        })
    }

    ///All recipes list filtering///
    
    this.document.getElementById("search").addEventListener('keyup', (event) => {
        if(event.key == 'Enter') {
            event.preventDefault()
        }
        let needle = this.document.getElementById("search").value.toLowerCase()
        filterResults(needle)
    })

    function filterResults(needle){
        let results = globalThis.document.querySelectorAll(".recipe-list-item");
        results.forEach(element => {
            if(!element.innerHTML.toLocaleLowerCase().includes(needle))
                element.hidden = true
            else
                element.hidden = false
        });
    }
})