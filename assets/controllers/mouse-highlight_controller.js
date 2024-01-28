import { Controller } from '@hotwired/stimulus';
//import axios from 'axios';

/*
 * A js class for highlighting mouse position on the calendar.
 */
export default class extends Controller {
  connect() {
    this.addHoverEventsAndClasses();
  }

  addHoverEventsAndClasses() {
    const mainTableTDs = this.element.querySelectorAll("td");
    const mainTableTRs = this.element.querySelectorAll("tr");
    //Dynamically add class names to each row and cell to target
    this.addClass(mainTableTDs, "cell");
    this.addClass(mainTableTRs, "cell");
    mainTableTDs.forEach((td) => {
      td.addEventListener("mouseenter", (е) => this.highlightCol(е));
      td.addEventListener("mouseleave", (е) => this.removeHighlightCol(е));
    });
  }

  //Helper function for adding highlight classes
  addClass(el, cl) {
    el.forEach((child) => {
        child.classList.add(cl);
    });
  }

  //Toggle highlight functions. Did it this way so multiple arguments could be passed
  highlightCol(e) {
    this.toggleHighlight(e, true);
  }

  removeHighlightCol(e) {
    this.toggleHighlight(e, false);
  }
  
  toggleHighlight(element, trueOrFalse) {
    const currentRow = this.returnCurRow(element);
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
  }

  //Grab the current row
  returnCurRow = (e) => {
    return e.currentTarget.parentElement.rowIndex;
  };
};
