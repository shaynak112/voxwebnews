  var myIndex = 0;
  var index2 = 1;

  function gallerySlideshow()
  {
      var y;
      var x = document.getElementsByClassName("slides");
      for (y = 0; y < x.length; y++)
      {
         x[y].style.display = "none";  
      }

      myIndex++;
      
      if (myIndex > x.length)
        {
          myIndex = 1;
        }    

      x[myIndex-1].style.display = "block";  
      setTimeout(gallerySlideshow, 4000);
  }

  

  gallerySlideshow();

