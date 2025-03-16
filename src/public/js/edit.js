document.querySelector('#input').addEventListener('change', (event) => {
  const file = event.target.files[0]

  // fileがundefinedの時にreader.readAsDataURL(file)がエラーになるため、
  // !fileがfalseの場合にreturnする。
  if (!file) return

  const reader = new FileReader()

  reader.onload = (event) => {
    document.querySelector('#img').src = event.target.result
  }

  reader.readAsDataURL(file)
})


const fileSelect = document.getElementById("fileSelect");
const fileElem = document.getElementById("input");

fileSelect.addEventListener("click", (e) => {
  if (fileElem) {
    fileElem.click();
  }
}, false);