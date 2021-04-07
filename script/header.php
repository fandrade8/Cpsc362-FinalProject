<!-- 
  Module Name: Header
  Date of Code: 3/25/2020
  Programmer's Name: Fernando Andrade
  Description: This module functions as the navigation bar for all of the project.
  Every other module will include this module so the navigation bar stays present throughout
  the entire site. It will also check if the user is logged in order to see whether to show 
  a logout button or a login button
  Data Structures(if any): None
  Algorithms(if any): None
 -->


<!DOCTYPE html>
<html>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="../css/login&register.css">
    <link rel="stylesheet" type="text/css" href="../css/grayscale.css">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <head>
        <title> Congo </title>
    </head>

    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php"><strong>Congo</strong></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"     aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse nav-fill" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="home.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="browse_items.php">Browse</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a>
            </li>

            <!-- Check and see if the user is logged in. If they are logged in then the nav bar will show a logout and delete account button
                  otherwise it will only show a login button -->
                <?php if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) )
                  {
                    ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="logout.php" role="button" aria-haspopup="true" aria-expanded="false">Logout</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="logout.php">Logout</a>                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="delete_account.php">Delete Account</a>
                      </div>
                    </li>

                    <!-- Using JQuery to make the dropdown button show when the user hovers over it instead of when the user clicks on it -->
                    <script type="text/javascript">
                      const $dropdown = $(".dropdown");
                      const $dropdownToggle = $(".dropdown-toggle");
                      const $dropdownMenu = $(".dropdown-menu");
                      const showClass = "show";
                       
                      $(window).on("load resize", function() {
                        if (this.matchMedia("(min-width: 768px)").matches) {
                          $dropdown.hover(
                            function() {
                              const $this = $(this);
                              $this.addClass(showClass);
                              $this.find($dropdownToggle).attr("aria-expanded", "true");
                              $this.find($dropdownMenu).addClass(showClass);
                            },
                            function() {
                              const $this = $(this);
                              $this.removeClass(showClass);
                              $this.find($dropdownToggle).attr("aria-expanded", "false");
                              $this.find($dropdownMenu).removeClass(showClass);
                            }
                          );
                        } else {
                          $dropdown.off("mouseenter mouseleave");
                        }
                      });

                    </script>
                    <?php 
                  }else{ 
                    ?>
                      <li class="nav-item">                     
                        <a class="nav-link" href="login.php">Login</a>
                      </li>                  
                    <?php 
                  } 
                ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
          <input class="form-control mr-sm-2" name="query" type="text" placeholder="Search the Congo" aria-label="Search">
          <button class="btn btn-primary my-2 my-sm-0" type="submit" value="search">Search</button>
        </form>
      </div>
    </nav>

</html>