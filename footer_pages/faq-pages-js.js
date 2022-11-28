
// query selection for selecting the specific class to work on
const faqHeaders = document.querySelectorAll(".main-container .question");

// properties to be true when button pressed
faqHeaders.forEach((header, i) => {
  header.addEventListener("click", () => {
    header.nextElementSibling.classList.toggle("active");

    // "+ " =  add
    // "-" = remove
    // Add and remove functions will specificially open the tab to show the answer
    const open = header.querySelector(".add");
    const close = header.querySelector(".remove");

    // to making answer stay active until not close by pressing "-"
    if (header.nextElementSibling.classList.contains("active")) {
      open.classList.remove("active");
      close.classList.add("active");
    } else {
      open.classList.add("active");
      close.classList.remove("active");
    }
  });
});