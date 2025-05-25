// Select elements with attributes
var toastListElements = document.querySelectorAll("[toast-list]");
var dataChoicesElements = document.querySelectorAll("[data-choices]");
var dataProviderElements = document.querySelectorAll("[data-provider]");

// Check if any of the elements exist
if (
  toastListElements.length > 0 ||
  dataChoicesElements.length > 0 ||
  dataProviderElements.length > 0
) {
  // Create script elements and add them to the document
  var toastifyScript = document.createElement("script");
  toastifyScript.type = "text/javascript";
  toastifyScript.src = "https://cdn.jsdelivr.net/npm/toastify-js";
  document.head.appendChild(toastifyScript);

  var choicesScript = document.createElement("script");
  choicesScript.type = "text/javascript";
  choicesScript.src = "{{ asset('admin/libs/choices.js/public/assets/scripts/choices.min.js')}}";
  document.head.appendChild(choicesScript);

  var flatpickrScript = document.createElement("script");
  flatpickrScript.type = "text/javascript";
  flatpickrScript.src = "{{ asset('admin/libs/flatpickr/flatpickr.min.js')}}";
  document.head.appendChild(flatpickrScript);
}
