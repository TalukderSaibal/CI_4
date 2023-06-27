// $(document).ready(function() {
//     $('#myForm').validate({
//       rules: {
//         title: {
//           required: true
//         },
//         slug: {
//           required: true,
//         },
//         summernote: {
//             required: true
//         },
//         description: {
//           required: true,
//         },
//         image: {
//             required: true
//         }
//       },
//       messages: {
//           title: {
//           required: "Please enter your title."
//         },
//         slug: {
//           required: "Please enter your slug",
//         },
//         summernote: {
//             required: "Please write a description",
//         },
//         description: {
//           required: "Please enter a descrition.",
//         },
//         image: {
//             required: "Please select an image.",
//         }
//       },

//         errorElement: "span", // Use <span> tags for error messages
//         errorClass: "error-message", // Apply the "error-message" class to error messages
//         highlight: function(element) {
//             $(element).addClass("error"); // Add the "error" class to the form field
//         },
//         unhighlight: function(element) {
//             $(element).removeClass("error"); // Remove the "error" class from the form field
//         },

//         submitHandler: function(form) {
//         var formData = new FormData(this);
//         $.ajax({
//             url:'/article_save',
//             type: 'POST',
//             data: formData,
//             success: function(response) {
//             console.log(response);
//         }
//         })
//     }
//     });
// });