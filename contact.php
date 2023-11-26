<!DOCTYPE html>
<html>
<head>
  <title>Contact Us | ICT Club</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <?php include 'links.php';?>
  <style>
    .contact-form {
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
      padding: 30px;
      margin-top: 50px;
    }
    .contact-info {
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
      padding: 30px;
      margin-top: 50px;
      height: 80%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .contact-info h2 {
      margin-bottom: 30px;
    }
    .contact-info p {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }
    .contact-info p i {
      margin-right: 10px;
    }
  
#chatIcon {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: darkcyan;
  color: #fff;
  text-align: center;
  cursor: pointer;
}

#chatIcon i {
  font-size: 24px;
  line-height: 50px;
}
#contactp{
  opacity: 0;
  transition: opacity 1s ease-in-out;
}
.footer {
      background-color: #343a40;
      color: #fff;
      padding: 50px 0;
    }
    .footer h4 {
      margin-bottom: 30px;
    }
    .footer ul {
      list-style: none;
      padding-left: 0;
      margin-bottom: 30px;
    }
    .footer ul li a {
      color: #fff;
    }
  </style>
</head>
<body>
  <!--navbar-->
  <?php include 'navbar.php';?>
  <div class="container">
    <div class="row g-0" id="contactp">
      <div class="col-md-6">
        <div class="contact-form">
          <h2 class="bottom-border colorIcon">Contact Us</h2>
          <form autocomplete="off">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3 text-md-center">Submit</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="contact-info bottom-border">
          <h2 class="bottom-border colorIcon">M-ICT Club Address</h2>
          <p><i class="fas fa-map-marker-alt fa-2x text-primary"></i>P.O. Box 1226, Moshi, Kilimanjaro</p>
          <p><i class="fa fa-phone text-primary fa-2x"></i>Tel: +255-27-2974 110<span></p>
          <p><i class="fa fa-envelope text-primary fa-2x"></i>example@mail.com</p>
          <p><i class="fa fa-fax text-primary fa-2x"></i>Fax: +255-27-2974108</p>
          <p><i class="fa fa-headset text-primary fa-2x"></i>Customer Support</p>
        </div>
      </div>
    </div>
  </div><br>

    <!--INCLUDING FOOTER FILE-->
    <?php include 'footer.php';?>
    
  <section id="chat">
    <!-- Chat Icon -->
    <div id="chatIcon">
      <i class="fas fa-comments"></i>
    </div>
  </section>
  <div id="chatIcon">
  <i class="fa fa-comments"></i>
</div>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/custom.js"></script> <!--Customer JavaScript file-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>








      
       <script>
        document.getElementById("chatIcon").addEventListener("click", function() {
  window.open("https://your-chat-page.com", "chatWindow", "width=400,height=600");
});

             window.onload = function() {
  document.getElementById("contactPage").style.opacity = 1;
};
        $('.navbar-toggler').click(function() {
  $('.navbar-collapse').toggleClass('collapsing');
});
       </script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>