// $(document).ready(function() {
//     $('#myForm').submit(function(event) {
//         event.preventDefault();

//         var title = $('#title').val();
//         var slug = $('#slug').val();

//         if(title === ''){
//             $('#titleErr').text('Please enter a title');
//             return;
//         }

//         if(slug === ''){
//             $('#slugErr').text('Please enter a slug');
//             return;
//         }


//         $(this).unbind('submit').submit();
//     });
// });

// Article Form validation
$(document).ready(function() {
    $('#myForm').validate({
      rules: {
        title: {
          required: true
        },
        slug: {
          required: true,
        },
        summernote: {
            required: true
        },
        description: {
          required: true,
        },
        image: {
            required: true
        }
      },
      messages: {
          title: {
          required: "Please enter your title."
        },
        slug: {
          required: "Please enter your slug",
        },
        summernote: {
            required: "Please write a description",
        },
        description: {
          required: "Please enter a descrition.",
        },
        image: {
            required: "Please select an image.",
        }
      },

      errorElement: "span", // Use <span> tags for error messages
      errorClass: "error-message", // Apply the "error-message" class to error messages
      highlight: function(element) {
        $(element).addClass("error"); // Add the "error" class to the form field
      },
      unhighlight: function(element) {
        $(element).removeClass("error"); // Remove the "error" class from the form field
      },

      submitHandler: function(form) {
        // Form submission logic goes here
        form.submit();
      }
    });
  });