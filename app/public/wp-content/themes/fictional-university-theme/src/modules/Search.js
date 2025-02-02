import $ from "jquery";

class Search {
  // 1. Describe and initiate the project
  constructor() {
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.typingTimer;
  }

  // 2. Events
  events() {
    this.openButton.on("click", () => this.openOverlay());
    this.closeButton.on("click", () => this.closeOverlay());
    $(document).on("keyup", (e) => this.keyPressDispatcher(e));
    this.searchField.on("keydown",()=> this.typingLogic);
  }

  // 3. Methods
  typingLogic() {
    clearTimeout(this.typingTimer)
    this.typingTimer=setTimeOut(()=>{console.log("This is a timeout test")},2000)
  }
  keyPressDispatcher(e) {
    if (!this.isOverlayOpen && e.keyCode == 83) {
      this.openOverlay();
    }
    if (this.isOverlayOpen && e.keyCode == 27) {
      this.closeOverlay();
    }
  }
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no--scroll");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no--scroll");
    this.isOverlayOpen = false;
  }
}

export default Search;
