const form = document.getElementById("search-form");
const query = document.getElementById("search-query");
const search = "/posts/search?q=";

function submit(event) {
  event.preventDefault();

  const url = search + query.value;
  window.location.href = url;
}

form.addEventListener("submit", submit);
