
// For selecting the each file 
// Using the query selection for selecting the class
var tab_lists = document.querySelectorAll(".sidebar-list ul li");
var tab_items = document.querySelectorAll(".sidebar-item"); 


// fuction for making the items apper when on that element
tab_lists.forEach(function(list){
  list.addEventListener("click", function(){
    var tab_data = list.getAttribute("data-tc");
    
    // to making items acitve
    tab_lists.forEach(function(list){
      list.classList.remove("active");
    });
    list.classList.add("active");
    

// fuction for making the items hidden when button pressed
    tab_items.forEach(function(item){

      // for blocking the text and making them hidden
      var tab_class = item.getAttribute("class").split(" ");
      if(tab_class.includes(tab_data)){
        item.style.display = "block";
      }
      else{
        item.style.display = "none";
      }
      
    })
    
  })
})