fetch("http://localhost:5000/")
    .then((response) => response.json())
    .then((data) => {
        const lists = document.getElementById("lists");     //get div that stores lists

        //Add list to (delete and add item) drop down menus
        data?.forEach((list) => {
        const option = document.createElement("option");
        option.textContent = list.name;
        document.getElementById("delete_list").appendChild(option);
        document.getElementById("add_item").appendChild(option.cloneNode(true));

        //Display list and it's elements
        const current_list = document.createElement("ul");
        current_list.textContent = list.name + " - " + list.description;

        for(let item of list.items){
            //Create list element
            const entry = document.createElement("li");
            entry.textContent = item.name + " (" + item.quantity + ")  ";
            
            //Create "delete item" button
            const remove_item_form = document.createElement("form");            //create form
            remove_item_form.action = "http://localhost:5000/index.php/delete-item"
            remove_item_form.method = "post";
            remove_item_form.style = "display:inline;";

            const remove_item_button = document.createElement("input");         //create button
            remove_item_button.type = "image";
            remove_item_button.src = "./resources/x_button.png";
            remove_item_button.width = 15;
            remove_item_button.height = 15;

            const remove_item_list = document.createElement("input");           //add list name to body
            remove_item_list.type = "hidden";   
            remove_item_list.name = "list";
            remove_item_list.value = list.name;

            const remove_item_name = document.createElement("input");           //add item name to body
            remove_item_name.type = "hidden";
            remove_item_name.name = "item";
            remove_item_name.value = item.name;
            
            //Build list element structure
            remove_item_form.appendChild(remove_item_button);
            remove_item_form.appendChild(remove_item_list);
            remove_item_form.appendChild(remove_item_name);
            entry.appendChild(remove_item_form);
            
            current_list.appendChild(entry);    //add list element to list
        }

        lists.appendChild(current_list);        //add list to lists div
        });
    })
    .catch((error) => {
        console.log("Error: ", error);
    });