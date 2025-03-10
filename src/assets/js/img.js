const dropLabel = document.querySelector("#drop-label");
  const fileInput = document.querySelector("#file-input");
  const preview = document.querySelector("#preview");
  const removeBtn = document.querySelector("#remove-btn");
  const dropText = document.querySelector("#drop-text");

  dropLabel.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropLabel.classList.add("dragover");
  });

  dropLabel.addEventListener("dragleave", () => {
    dropLabel.classList.remove("dragover");
  });

  dropLabel.addEventListener("drop", (e) => {
    e.preventDefault();
    dropLabel.classList.remove("dragover");

    const file = e.dataTransfer.files[0];
    handleFile(file);
  });

  fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    handleFile(file);
  });

  removeBtn.addEventListener("click", () => {
    preview.src = "";
    preview.style.display = "none";
    removeBtn.style.display = "none";
    dropText.style.display = "block";
    fileInput.value = "";
  });

  function handleFile(file) {
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
        preview.style.display = "block";
        removeBtn.style.display = "inline-block";
        dropText.style.display = "none";
      };
      reader.readAsDataURL(file);
    } else {
      alert("Por favor, selecione um arquivo de imagem.");
    }
  }