const form = document.getElementById("search-form");
const query = document.getElementById("search-query");
const search = "posts/search=";

function submit(event) {
  event.preventDefault();

  const url = search + query.value;
  window.open(url, "_blank").focus();
}

form.addEventListener("submit", submit);
