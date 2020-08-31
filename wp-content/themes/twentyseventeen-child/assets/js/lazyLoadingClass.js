
function LazyLoadingClass(XMLHttpRequest, type, selectorSection, selectorBox, selectorSubBox, selectorAdd, selectorClose) {

    var XMLHttpRequest = XMLHttpRequest;
    var type = type;
    var selector = selector;

    return {

        active: function () {

            if (type === 'scroll-loading-more-data-from-api-end-of-elment') {

                window.addEventListener('scroll', function () {

                    var windowRelativeBottom = document.querySelector(selectorBox).getBoundingClientRect().bottom;

                    if (windowRelativeBottom < 1000) {

                        XMLHttpRequest.send();
                    }
                });
            }

            if (type === 'loading-more-data-exist-in-dom-end-of-elment') {

                (function () {

                    var pos = 1;

                    if (document.querySelector(selectorAdd)) {

                        document.querySelector(selectorAdd).addEventListener('click', function () {

                            if (document.querySelector(selectorSubBox + pos)) {
                                document.querySelector(selectorSubBox + pos).style.width = '100%';
                                document.querySelector(selectorSubBox + pos).style.height = 'auto';
                                document.querySelector(selectorSubBox + pos).style.opacity = '1';

                                pos++;

                                document.querySelector(selectorClose).style.display = 'inline-block';
                            }

                            if (!document.querySelector(selectorSubBox + pos))
                                document.querySelector(selectorAdd).style.display = 'none';

                        });
                    }

                    if (document.querySelector(selectorClose)) {

                        document.querySelector(selectorClose).addEventListener('click', function () {

                            var element;
                            var whilePos = 1;

                            while (element = document.querySelector(selectorSubBox + whilePos)) {

                                element.style.width = '0px';
                                element.style.height = '0px';
                                element.style.opacity = '0';

                                whilePos++;
                            }

                            pos = 1;

                            document.querySelector(selectorClose).style.display = 'none';
                            document.querySelector(selectorAdd).style.display = 'inline-block';

                            window.scrollTo({
                                'behavior': 'smooth',
                                'left': 0,
                                'top': document.querySelector(selectorSection).offsetTop
                            });

                        });

                    }

                })();
            }

            if (type === 'loading-more-data-exist-in-dom-end-of-elment-one-elment') {

                if (document.querySelector(selectorAdd)) {

                    document.querySelector(selectorAdd).addEventListener('click', function () {

                        document.querySelector(selectorBox).classList.remove('content-close');
                        document.querySelector(selectorBox).classList.add('content-open');

                        document.querySelector(selectorAdd).style.display = 'none';
                        document.querySelector(selectorClose).style.display = 'inline-block';
                        
                    });
                }

                if (document.querySelector(selectorClose)) {

                    document.querySelector(selectorClose).addEventListener('click', function () {

                        document.querySelector(selectorBox).classList.remove('content-open');
                        document.querySelector(selectorBox).classList.add('content-close');

                        document.querySelector(selectorClose).style.display = 'none';
                        document.querySelector(selectorAdd).style.display = 'inline-block';

                        window.scrollTo({
                            'behavior': 'smooth',
                            'left': 0,
                            'top': document.querySelector(selectorSection).offsetTop
                        });

                    });
                }
            }
        }
    }
}