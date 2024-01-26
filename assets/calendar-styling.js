window.addEventListener('load', function () {
    addHoverEventsAndClasses();
  });

function toggleHighlight(element, trueOrFalse) {
  const currentRow = returnCurRow(element);
  const index = element.currentTarget.cellIndex;
  const table = document.getElementById('calendar').rows;
  for (var i = 0; i < table.length; i++) {
    const data = table[i];
    const cells = data.querySelectorAll(".cell");
    if(data.rowIndex === currentRow) {
      cells.forEach((td) => {
          trueOrFalse ? td.classList.add("hoverHighlight") : td.classList.remove("hoverHighlight");
      });
    }
    cells.forEach((cell) => {
        if(cell.cellIndex === index) {
            trueOrFalse ? cell.classList.add("hoverHighlight") : cell.classList.remove("hoverHighlight");
        }
    });
	}
};

function addHoverEventsAndClasses() {
  const mainTableTDs = document.querySelectorAll("#calendar td");
  const mainTableTRs = document.querySelectorAll("#calendar tr");
  //Dynamically add class names to each row and cell to target
  addClass(mainTableTDs, "cell");
  addClass(mainTableTRs, "cell");
  mainTableTDs.forEach((td) => {
      td.addEventListener("mouseenter", highlightCol); 
      td.addEventListener("mouseleave", removeHighlightCol);
  });
}

//Helper function for adding highlight classes
function addClass(el, cl) {
  el.forEach((child) => {
      child.classList.add(cl);
  });
}

//Toggle highlight functions. Did it this way so multiple arguments could be passed
function highlightCol(e) {
  toggleHighlight(e, true);
}

function removeHighlightCol(e) {
  toggleHighlight(e, false);
}

//Grab the current row
const returnCurRow = (e) => {
  return e.currentTarget.parentElement.rowIndex;
};
