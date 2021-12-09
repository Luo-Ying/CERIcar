$(document).ready(function() {
  
    var animating = false,
        submitPhase1 = 1100,
        submitPhase2 = 400,
        logoutPhase1 = 800,
        $login = $(".login"),
        $app = $(".app");
    
    function ripple(elem, e) {
      $(".ripple").remove();
      var elTop = elem.offset().top,
          elLeft = elem.offset().left,
          x = e.pageX - elLeft,
          y = e.pageY - elTop;
      var $ripple = $("<div class='ripple'></div>");
      $ripple.css({top: y, left: x});
      elem.append($ripple);
    };
    
    $(document).on("click", ".login__submit", function(e) {
      if (animating) return;
      animating = true;
      var that = this;
      ripple($(that), e);
      $(that).addClass("processing");
      setTimeout(function() {
        $(that).addClass("success");
        setTimeout(function() {
          $app.show();
          $app.css("top");
          $app.addClass("active");
        }, submitPhase2 - 70);
        setTimeout(function() {
          $login.hide();
          $login.addClass("inactive");
          animating = false;
          $(that).removeClass("success processing");
        }, submitPhase2);
      }, submitPhase1);
    });
    
    // $(document).on("click", ".app__logout", function(e) {
    //   if (animating) return;
    //   $(".ripple").remove();
    //   animating = true;
    //   var that = this;
    //   $(that).addClass("clicked");
    //   setTimeout(function() {
    //     $app.removeClass("active");
    //     $login.show();
    //     $login.css("top");
    //     $login.removeClass("inactive");
    //   }, logoutPhase1 - 120);
    //   setTimeout(function() {
    //     $app.hide();
    //     animating = false;
    //     $(that).removeClass("clicked");
    //   }, logoutPhase1);
    // });
    
  });


// /**
//  * 
//  * @param {string} message 
//  * @param {"success"|"warning"|"danger"} [criticality]
//  * @param {string} title
//  */
// function displayBanner(message, criticality, title){
//     if(criticality === undefined){
//         criticality = "success";
//     }
//     if(title === undefined){
//       criticality = "success";
//     }

//     $.ajax({
//     url: "monApplicationAjax.php?action=banner",
//     type: "post",
//     data: {"identifiant":$('#case-identifiant').val(), "pass":$('#case-pass').val()},
//     data:{
//         message: message,
//         criticality: criticality,
//         title: title,
//     },
//     success:function(reponse){
//           $("#banner-notification").html(reponse);

//           setTimeout(function(){
//             $("#banner-notification").show();
//           }, 500);

//           setTimeout(function(){
//             $("#banner-notification").css('display', 'none');
//           }, 2500);
//         },
//         error: console.error
//     });
// }


// JS of template form reservation
var alertRedInput = "#8C1010";
var defaultInput = "rgba(10, 180, 180, 1)";

function userNameValidation(usernameInput) {
    var username = document.getElementById("case-newUserName");
    var issueArr = [];
    if (/[-!@#$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/.test(usernameInput)) {
      issueArr.push("No special characters!");
    }
    // console.log(issueArr);
    // console.log(username);
    if (issueArr.length > 0) {
        username.setCustomValidity(issueArr);
        username.style.borderColor = alertRedInput;
    } else {
        username.setCustomValidity("");
        username.style.borderColor = defaultInput;
    }
}

function passwordValidation(passwordInput) {
    var password = document.getElementById("case-newPassword");
    var issueArr = [];
    if (!/^.{7,15}$/.test(passwordInput)) {
        issueArr.push("Password must be between 7-15 characters.");
    }
    if (!/\d/.test(passwordInput)) {
        issueArr.push("Must contain at least one number.");
    }
    if (!/[a-z]/.test(passwordInput)) {
        issueArr.push("Must contain a lowercase letter.");
    }
    if (!/[A-Z]/.test(passwordInput)) {
        issueArr.push("Must contain an uppercase letter.");
    }
    if (issueArr.length > 0) {
        password.setCustomValidity(issueArr.join("\n"));
        password.style.borderColor = alertRedInput;
    } else {
        password.setCustomValidity("");
        password.style.borderColor = defaultInput;
    }
}