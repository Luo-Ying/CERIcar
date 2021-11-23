// $(".btn-Rechercher-voyages").click(function(){
//     $.get( "monApplication.php?action=searcheVoyage", function(data) {
//         $( "#mainContent" ).html( data );
//     });
// });

function insert() {
    $.ajax({
        type: "POST",//方法
        url: "monApplication.php?action=searcheVoyage" ,//表单接收url
        data: $('#search-form').serialize(),
        success: function () {
          //提交成功的提示词或者其他反馈代码
            var result=document.getElementById("btn-Rechercher-voyages");
            result.innerHTML="成功!";
        },
        error : function() {
          //提交失败的提示词或者其他反馈代码
            var result=document.getElementById("btn-Rechercher-voyages");
            result.innerHTML="失败!";
        }
    });
}
