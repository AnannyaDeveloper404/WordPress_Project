import $ from "jquery";

class Search {
  // 1. Describe and initiate the project
  constructor() {
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.typingTimer;
    this.isSpinnerVisible = false;
    this.previousValue;
  }

  // 2. Events
  events() {
    this.openButton.on("click", () => this.openOverlay());
    this.closeButton.on("click", () => this.closeOverlay());
    $(document).on("keyup", (e) => this.keyPressDispatcher(e));
    this.searchField.on("keyup", () => this.typingLogic());
  }

  // 3. Methods
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(() => this.getResults(), 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }

      this.previousValue = this.searchField.val();
    }
  }
  getResults() {
    $.getJSON()
    $.when(
      $.getJSON(
        `${universityData.root_url}/wp-json/wp/v2/posts?search=${this.searchField.val()}`
      ),
      $.getJSON(
        `${universityData.root_url}/wp-json/wp/v2/pages?search=${this.searchField.val()}`
      )
    ).then(
      (posts, pages) => {
        var combinedResult = posts[0].concat(pages[0]);
        this.resultsDiv.html(`
            <h2 class="search-overlay__section-title">General Information</h2>
        ${combinedResult.length ? '<ul class="link-list min-list">' : "<p>No general info</p>"}
              ${combinedResult.map((item) => `<li><a href='${item.link}'>${item.title.rendered}</a> ${item.type == "post" ? `by ${item.authorName}` : ""}</li>`)} 
             ${combinedResult.length ? "</ul>" : ""}
          `);
        this.isSpinnerVisible = false;
      },
      () => {
        this.resultsDiv.html("<p>Unexpected Error</p>");
      }
    );
  }
  keyPressDispatcher(e) {
    if (
      !this.isOverlayOpen &&
      e.keyCode == 83 &&
      !$("input,textarea").is(":focus")
    ) {
      this.openOverlay();
    }
    if (this.isOverlayOpen && e.keyCode == 27) {
      this.closeOverlay();
    }
  }
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no--scroll");
    this.searchField.val("");
    setTimeout(() => this.searchField.focus(), 301);
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no--scroll");
    this.isOverlayOpen = false;
  }
}

export default Search;
