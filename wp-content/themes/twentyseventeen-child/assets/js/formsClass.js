
function formsClass() {

    var coreController = (function () {

        var formData;
        var forms;
        var categoryID;
        var categories;
        var subCategories;
        var search;
        var searchType;
        var getFormsXMLHttpRequest;
        var subCategoriesXMLHttpRequest;
        var lastEventKeyup;
        var searchCallback;

        return {

            setFormData: function (obj) {

                formData = obj;
            },
            addFieldFormData: function (type, name, value, ex) {

                if (type === 'string')
                    formData.append(name, value);
                if (type === 'file')
                    formData.append(name, value, ex);
            },
            getFormData: function () {

                return formData;
            },
            setForms: function (arr) {

                forms = arr;
            },
            getForms: function () {

                return forms;
            },
            setSubCategories: function (arr) {

                subCategories = arr;
            },
            getSubCategories: function () {

                return subCategories;
            },
            setCategoryID: function (id) {

                categoryID = id;
            },
            getCategoryID: function () {

                return categoryID;
            },
            setSearchType: function (type) {

                searchType = type;
            },
            getSearchType: function () {

                return searchType;
            },
            setLastEventKeyup: function () {

                lastEventKeyup = new Date().getTime();
            },
            getLastEventKeyup: function () {

                return lastEventKeyup;
            },
            setSearchCallback: function (callback) {

                searchCallback = callback;
            },
            getSearchCallback: function () {

                return searchCallback;
            },
            setGetFormsXMLHttpRequest: function (XMLHttpRequest) {

                getFormsXMLHttpRequest = XMLHttpRequest;
            },

            getGetFormsXMLHttpRequest: function () {

                return getFormsXMLHttpRequest;
            },
            setSubCategoriesXMLHttpRequest: function (XMLHttpRequest) {

                subCategoriesXMLHttpRequest = XMLHttpRequest;
            },
            getsubCategoriesXMLHttpRequest: function () {

                return subCategoriesXMLHttpRequest;
            },
            getForms: function (obj) {

                getFormsXMLHttpRequest.send(obj);
            },
            setSubCategories: function (obj) {

                subCategoriesXMLHttpRequest.send(obj);
            }
        }

    })();

    var UIController = (function () {


        return {

            activeFilter: function (filter) {
                var element;

                if (filter === 'sub-category') {

                    element = document.querySelector('.sub-category-filter');

                    element.classList.remove('not-active');
                    element.classList.add('active');
                }
            },

            addSubCategory: function (category) {
                var element, html;

                element = document.querySelector('#sub-category');

                html = '<option value="' + category.term_id + '">' + category.name + '</option>';

                element.insertAdjacentHTML("beforeend", html);
            },

            setSubCategories: function (categories) {
                var element, html;

                element = document.querySelector('#sub-category');

                element.textContent = '';

                html = '<option value="0">בחר תת נושא</option>';

                element.insertAdjacentHTML("beforeend", html);

                for (i = 0; i < categories.length; i++) {

                    this.addSubCategory(categories[i]);

                }

            },

            addForm: function (form) {
                var element, html;

                element = document.querySelector('.content-box');

                html = '<div class="box-movie"><a href="/movieWebsiteWordpress/movie/' + form.post_name + '">' + form.post_title + '</a></div>';

                element.insertAdjacentHTML("beforeend", html);
            },

            setForms: function (forms) {
                var element;

                element = document.querySelector('.content-box');

                element.innerHTML = '';

                for (i = 0; i < forms.length; i++) {

                    this.addForm(forms[i]);

                }
                
                element.style.display = 'block';
            }
        }

    })();

    var setFormData = function () {

        coreController.setFormData(new FormData());
    }

    var setForms = function (forms) {

        coreController.setForms(forms);

        UIController.setForms(forms);
    }

    var setSubCategories = function (categories) {

        coreController.setSubCategories(categories);

        UIController.setSubCategories(categories);
    }

    var setCategoryID = function () {

        coreController.addFieldFormData('string', 'categoryID', coreController.getCategoryID());
    }

    var listEvenListener = function () {
        var obj, search, lastValue, category, subCategory, nowEventKeyup, btnClose;
        btnClose = document.querySelector('.box-search .close-data');
        search = document.querySelector('#search');
        category = document.querySelector('#category');
        subCategory = document.querySelector('#sub-category');

        obj = {};
        
        if(btnClose) {
            
            btnClose.addEventListener('click', function () {
                
                document.querySelector('.content-box').style.display = 'none';
                btnClose.style.display = 'none';
            });
        }

        if (search) {

            search.addEventListener('keyup', function () {

                nowEventKeyup = parseInt(new Date().getTime());

                coreController.setSearchCallback(function (now) {
                    var value;

                    value = search.value;

                    if (value !== '' && now > (nowEventKeyup + 500) && lastValue !== value) {

                        coreController.addFieldFormData('string', 'search', value);
                        coreController.addFieldFormData('string', 'searchType', 'search');
                        coreController.setSearchType('search');
                        obj.type = 'search';
                        coreController.getForms(obj);

                        lastValue = value;
                    }

                });

            });
        }

        if (category) {

            category.addEventListener('change', function () {
                var value;
                value = category.value;
                coreController.addFieldFormData('string', 'search', '');
                coreController.addFieldFormData('string', 'category', value);
                coreController.addFieldFormData('string', 'searchType', 'category');
                coreController.setSearchType('category');
                obj.type = 'category';
                coreController.getForms(obj);

                coreController.addFieldFormData('string', 'categoryID', value);
                coreController.setSubCategories(obj);
                UIController.activeFilter('sub-category');
            });
        }

        if (subCategory) {

            subCategory.addEventListener('change', function () {
                var value;
                value = subCategory.value;
                if (value === '0') {
                    value = category.value;
                }
                coreController.addFieldFormData('string', 'search', '');
                coreController.addFieldFormData('string', 'category', value);
                coreController.addFieldFormData('string', 'searchType', 'category');
                coreController.setSearchType('category');
                obj.type = 'sub-category';
                coreController.getForms(obj);

            });
        }
    }

    return {

        getFormData: function () {

            return coreController.getFormData();
        },
        setForms: function (arr) {

            setForms(arr);
        },
        setSubCategories: function (arr) {

            setSubCategories(arr);
        },
        getSearchCallback: function () {

            return coreController.getSearchCallback() ? coreController.getSearchCallback() : function () {};
        },
        init: function (getFormsXMLHttpRequest, setSubCategoriesXMLHttpRequest) {

            setFormData();
            coreController.setGetFormsXMLHttpRequest(getFormsXMLHttpRequest);
            coreController.setSubCategoriesXMLHttpRequest(setSubCategoriesXMLHttpRequest);
            listEvenListener();
        }
    }
}