<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Slider Nav</title>
    <link rel="stylesheet" href="nav.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Hero --> 
    <section class="et-hero-tabs">
        <h1>STICKY SLIDER NAV</h1>
        <h3>Sliding content with sticky tab nav</h3>
        <div class="et-hero-tabs-container">
            <a class="et-hero-tab" href="#tab-es6">ES6</a>
            <a class="et-hero-tab" href="#tab-flexbox">Flexbox</a>
            <a class="et-hero-tab" href="#tab-react">React</a>
            <a class="et-hero-tab" href="#tab-angular">Angular</a>
            <a class="et-hero-tab" href="#tab-other">Other</a>
            <span class="et-hero-tab-slider"></span>
        </div>
    </section>
    
    <!-- Main -->
    <main class="et-main">
        <section class="et-slide" id="tab-es6">
            <h1>ES6</h1>
            <h3>something about es6</h3>
        </section>
        <section class="et-slide" id="tab-flexbox">
            <h1>Flexbox</h1>
            <h3>something about flexbox</h3>
        </section>
        <section class="et-slide" id="tab-react">
            <h1>React</h1>
            <h3>something about react</h3>
        </section>
        <section class="et-slide" id="tab-angular">
            <h1>Angular</h1>
            <h3>something about angular</h3>
        </section>
        <section class="et-slide" id="tab-other">
            <h1>Other</h1>
            <h3>something about other</h3>
        </section>
    </main>
    
    <script>
        class StickyNavigation {
            constructor() {
                this.currentId = null;
                this.currentTab = null;
                this.tabContainerHeight = 70;
                $(document).ready(() => {
                    $('.et-hero-tab').click((event) => this.onTabClick(event));
                    $(window).scroll(() => this.onScroll());
                    $(window).resize(() => this.onResize());
                });
            }

            onTabClick(event) {
                event.preventDefault();
                let element = $(event.currentTarget);
                let scrollTop = $(element.attr('href')).offset().top - this.tabContainerHeight + 1;
                $('html, body').animate({ scrollTop: scrollTop }, 600);
            }

            onScroll() {
                this.checkTabContainerPosition();
                this.findCurrentTabSelector();
            }

            onResize() {
                if (this.currentId) {
                    this.setSliderCss();
                }
                // Update the tab container height if necessary on resize
                this.tabContainerHeight = $('.et-hero-tabs-container').outerHeight();
            }

            checkTabContainerPosition() {
                let offset = $('.et-hero-tabs').offset().top + $('.et-hero-tabs').height() - this.tabContainerHeight;
                if ($(window).scrollTop() > offset) {
                    $('.et-hero-tabs-container').addClass('et-hero-tabs-container--top');
                } else {
                    $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top');
                }
            }

            findCurrentTabSelector() {
                let newCurrentId;
                let newCurrentTab;
                $('.et-hero-tab').each((_, tab) => {
                    let id = $(tab).attr('href');
                    let offsetTop = $(id).offset().top - this.tabContainerHeight;
                    let offsetBottom = $(id).offset().top + $(id).height() - this.tabContainerHeight;
                    if ($(window).scrollTop() > offsetTop && $(window).scrollTop() < offsetBottom) {
                        newCurrentId = id;
                        newCurrentTab = $(tab);
                    }
                });
                if (this.currentId !== newCurrentId || this.currentId === null) {
                    this.currentId = newCurrentId;
                    this.currentTab = newCurrentTab;
                    this.setSliderCss();
                }
            }

            setSliderCss() {
                let width = 0;
                let left = 0;
                if (this.currentTab) {
                    width = this.currentTab.css('width');
                    left = this.currentTab.offset().left;
                }
                $('.et-hero-tab-slider').css('width', width);
                $('.et-hero-tab-slider').css('left', left);
            }
        }

        new StickyNavigation();
    </script>
</body>
</html>
