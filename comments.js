


function charCount() {

    var myText = document.getElementById("comments");
    var wordCount = document.getElementById("wordCount");
    var maxLength = 200;
   
    myText.addEventListener("keyup", function(){
        var characters = myText.value.split('');
        wordCount.innerText = maxLength - characters.length;
    });
};

function commentEmpty() {
    var myButton = document.getElementById("comment_button");
    var myText = document.getElementById("comments");

    myButton.addEventListener("click", function(){
        var commentChars = myText.value.split('');

        if(commentChars.length == 0) {
             alert('You must enter a comment');
        }else{
            alert('Thank you. Your comment has been saved.');
        };
       
    });

};


window.onload = function() {
    charCount();
    commentEmpty();
    
};