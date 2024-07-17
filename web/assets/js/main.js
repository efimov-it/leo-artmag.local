const YAMAP_APIKEY = "651e9520-22f9-40ab-87f7-7429a91f8573";
const YAMAP_STATIC_APIKEY = "136c5155-0bd6-4639-b4db-c850d4001a6f";

document.addEventListener('DOMContentLoaded', () => {
    
    // Активация сканера штрихкодов
    // document.querySelector('.leo-headerSerchButton').onclick = (e) => {
    //     e.preventDefault();
    //     alert('Сканер штрихкодов');
    // }

    // Модальные окна
    const showModal = async (id) => {
        const modal = document.getElementById(id);

        if (!modal) {
            return new Error('Can\'t find modal with id "' + id + '".');
        }

        if (!modal.classList.contains('leo-modalWrapper')) {
            return new Error('Element with id "' + id + '" is not a modal.');
        }

        const background = modal.querySelector('.leo-modalWrapper_background');
        const content = modal.querySelector('.leo-modal');

        if (!background || !content) {
            return new Error('Element with id "' + id + '" is not a modal.');
        }
        
        modal.style.display = null;
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            background.classList.add('leo-modalWrapper_background__shown');
            content.classList.add('leo-modal__shown');
        }, 10);
    }
    const closeModal = async (id) => {
        const modal = document.getElementById(id);

        if (!modal) {
            return new Error('Can\'t find modal with id "' + id + '".');
        }

        if (!modal.classList.contains('leo-modalWrapper')) {
            return new Error('Element with id "' + id + '" is not a modal.');
        }

        const background = modal.querySelector('.leo-modalWrapper_background');
        const content = modal.querySelector('.leo-modal');

        if (!background || !content) {
            return new Error('Element with id "' + id + '" is not a modal.');
        }
    
        background.classList.remove('leo-modalWrapper_background__shown');
        content.classList.remove('leo-modal__shown');

        setTimeout(() => {
            modal.style.display = 'none';
            if (document.querySelectorAll('.leo-modal__shown').length === 0) {
                document.body.style.overflow = null;
            }
        }, 350);
    }
    const closeAllModal = async () => {
        document.querySelectorAll('.leo-modalWrapper').forEach (modal => {
            if (!modal) {
                return;
            }
    
            if (!modal.classList.contains('leo-modalWrapper')) {
                return;
            }
    
            const background = modal.querySelector('.leo-modalWrapper_background');
            const content = modal.querySelector('.leo-modal');
    
            if (!background || !content) {
                return;
            }
        
            background.classList.remove('leo-modalWrapper_background__shown');
            content.classList.remove('leo-modal__shown');
    
            setTimeout(() => {
                modal.style.display = 'none';
            }, 350);
        });

        location.hash = '';
        document.body.style.overflow = null;
    }

    
    // Закрытие модальных окон
    // при нажатии на ×
    document.querySelectorAll('.leo-modal_close').forEach( closeIcon => {
        closeIcon.onclick = () => {
            const modal = closeIcon.parentElement.parentElement;
            closeModal(modal.id);

            if (document.querySelectorAll('.leo-modal__shown').length === 0) {
                location.hash = '';
            }
        }
    });

    
    // Закрытие модальных окон
    // при нажатии на фон
    document.querySelectorAll('.leo-modalWrapper_background').forEach( background => {
        background.onclick = () => {
            const modal = background.parentElement;
            closeModal(modal.id);
            if (document.querySelectorAll('.leo-modal__shown').length === 0) {
                location.hash = '';
            }
        }
    });



    // Якорные ссылки
    function hashTriger (hash) {
        if (hash === 'menu') showModal('mobileMenu');
        if (hash === 'menu-user') showModal('mobileMenuUser');
        if (hash === 'menu-about') showModal('mobileMenuAbout');
        if (hash === 'menu-help') showModal('mobileMenuHelp');
        if (hash === 'subscribe') showModal('subscribeModal');

        if (hash.indexOf('catalog') === 0) {
            showModal(hash);
        }
    }

    // Маршрутизация по якорным ссылкам
    document.querySelectorAll('a').forEach (link => {
        const url = link.href;

        if (url.indexOf('#') > 0) {
            link.onclick = () => {
                const hash = url.substring(url.indexOf('#') + 1);
                
                hashTriger(hash);
            }
        }
    });

    // Маршрутизация по якорным ссылкам после загрузки страницы
    hashTriger(location.hash.substring(1));


    // Обработка подписки на рассылку
    (function () {
        const subscribeForm = document.querySelector('#subscribeForm')
        subscribeForm.onsubmit = async (e) => {
                e.preventDefault();
                const formData = new FormData(subscribeForm);
                
                // TODO: Add fetch
    
                closeModal('subscribeModal');
                showModal('subscribeModalResult');
    
                subscribeForm.reset();
        }
        document.querySelector('#subscribeFormDoneBtn').onclick = closeAllModal;
    })();


    // Открытие десктопного каталога
    (function () {
        const desktopCatalogButton = document.querySelector('#desktopCalatogBtn');
        const desktopCatalog = document.querySelector('.leo-catalogPopup');

        desktopCatalogButton.onclick = () => {
            if (desktopCatalog.classList.contains('leo-catalogPopup__active')) {
                desktopCatalog.classList.remove('leo-catalogPopup__active');
                desktopCatalogButton.style.opacity = null;
                setTimeout(() => {
                    document.body.style.overflow = null;
                    desktopCatalog.style.display = null;
                }, 400);
            }
            else {
                window.scrollTo({
                    left: 0,
                    top: 0,
                    behavior: 'smooth'
                });
                desktopCatalogButton.style.opacity = '0';
                desktopCatalog.style.display = 'flex';
                setTimeout(() => {
                    document.body.style.overflow = 'hidden';
                    desktopCatalog.classList.add('leo-catalogPopup__active');
                }, 10);
            }
        }
    })();


    // Переключение пунктов десктопного каталога (поп-ап)
    (function () {
        let lastCatalogItem = document.querySelector('.leo-catalogPopupItem');
        document.querySelectorAll('.leo-catalogPopupItem').forEach(catalogItem => {
            catalogItem.onclick = () => {
                lastCatalogItem.classList.remove('leo-catalogPopupItem__active');
                catalogItem.classList.add('leo-catalogPopupItem__active');
                lastCatalogItem = catalogItem;
            }
        });
    })();


    // Открытие окна для выбора магазина
    (function () {
        const currentShopData = JSON.parse(document.querySelector('#currentShopData').textContent)

        const citiesItems = document.querySelectorAll('.leo-shopListCitiesItem');
        const shopsItems = document.querySelectorAll('.leo-shopListBlockItem');

        let currentCityId;
        let currentShopId;

        let map;

        async function initMap() {
            if (ymaps3) {
                await ymaps3.ready;
    
                const {
                    YMap,
                    YMapDefaultSchemeLayer,
                    YMapDefaultFeaturesLayer,
                    YMapMarker
                } = ymaps3;
    
                map = new YMap(
                    document.querySelector('#yamapShopList'),
                    {
                        location: {
                            center: currentShopData.geo,
                            zoom: 16
                        }
                    },
                    [
                        new YMapDefaultFeaturesLayer({})
                    ]
                );
    
                map.addChild(new YMapDefaultSchemeLayer());

                document.querySelectorAll('.leo-shopListBlockItem script').forEach(shopData => {
                    shopData = JSON.parse(shopData.textContent);
                    
                    const markerElement = document.createElement('img');
                    markerElement.className = 'leo-yamapMarker';
                    markerElement.src = "/assets/images/map-marker.svg";
                    markerElement.dataset.shopid = shopData.id;
                    markerElement.width = "28";
                    markerElement.height = "37";
                    markerElement.alt = "";

                    const marker = new YMapMarker(
                        {
                            coordinates: shopData.geo
                        },
                        markerElement
                    );

                    map.addChild(marker);
                });

                // Выбор магазина по карте
                document.querySelectorAll('.leo-yamapMarker').forEach(shopMarker => {
                    shopMarker.onclick = () => {
                        showShopModal(
                            JSON.parse(
                                document.querySelector(
                                    '.leo-shopListBlockItem[data-shopid="' + shopMarker.dataset.shopid + '"] script'
                                ).textContent
                            )
                        );
                    }
                });
            }
        }

        initMap();

        // Открыть окно выбора магазина
        document.querySelectorAll('.leo-shopSelectButton').forEach(shopSelectBtn => {
            shopSelectBtn.onclick = () => {
                closeModal('shopsDataModal');
                
                const shopListCitySearch = document.querySelector('#shopListCitySearch');
                if (shopListCitySearch) {
                    shopListCitySearch.value = '';
                }

                citySearch('');
                
                document.querySelector('.leo-shopListCitiesItem__active')?.classList.remove('leo-shopListCitiesItem__active');
                document.querySelector('.leo-shopListBlock_list__active')?.classList.remove('leo-shopListBlock_list__active');
                document.querySelector('.leo-shopListCitiesItem[data-cityid="' + currentShopData.cityid + '"]')?.classList.add('leo-shopListCitiesItem__active');
                document.querySelector('.leo-shopListBlock_list[data-id="' + currentShopData.cityid + '"]')?.classList.add('leo-shopListBlock_list__active');

                map.setLocation({
                    center: currentShopData.geo,
                    zoom: 16
                });

                showModal('shopsModal');
            }
        });

        // Поиск по названию города
        const citySearch = (query) => {
            if (query === '') {
                citiesItems.forEach(item => {
                    item.style.display = null;
                });
            }
            else {
                citiesItems.forEach(item => {
                    const name = item.querySelector('.leo-shopListCitiesItem_name').textContent;

                    if (name.toLowerCase().indexOf(query.toLowerCase()) === -1) {
                        item.style.display = 'none';
                    }
                    else {
                        item.style.display = null;
                    }
                });
            }
        }
        const shopListCitySearch = document.querySelector('#shopListCitySearch');
        if (shopListCitySearch) shopListCitySearch.oninput = (e) => citySearch(e.target.value);

        // Выбор города
        citiesItems.forEach (city => {
            city.onclick = () => {
                closeModal('shopsDataModal');

                document.querySelector('.leo-shopListCitiesItem__active')?.classList.remove('leo-shopListCitiesItem__active');
                document.querySelector('.leo-shopListBlock_list__active')?.classList.remove('leo-shopListBlock_list__active');
                
                city.classList.add('leo-shopListCitiesItem__active');
                document.querySelector('.leo-shopListBlock_list[data-id="' + city.dataset.cityid + '"]')?.classList.add('leo-shopListBlock_list__active');
                
                if (map) {
                    map.setLocation({
                        center: JSON.parse(city.dataset.citygeo),
                        zoom: 9
                    });
                }
            }
        });

        // Выбор магазина из списка
        shopsItems.forEach(shop => {
            shop.onclick = () => {
                showShopModal(JSON.parse(shop.querySelector('script').textContent));
            }
        });

        // Поиск ближайшего мазагина
        const getClosetShopBtn = document.querySelector('#getClosetShopBtn');
        if ("geolocation" in navigator) {
            getClosetShopBtn.onclick = () => {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const getDistance = (x1, y1, x2, y2) => {
                            return Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
                        }

                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        
                        const tmpShops = [];

                        document.querySelectorAll('.leo-shopListBlockItem script').forEach(shopData => {
                            tmpShops.push(JSON.parse(shopData.textContent));
                        });
                        
                        let nearest = tmpShops[0];
                        let minDistance = getDistance(latitude, longitude, nearest[0], nearest[1]);

                        tmpShops.forEach(tmpShop => {
                            let distance = getDistance(latitude, longitude, tmpShop.geo[0], tmpShop.geo[1]);
                            if (distance < minDistance) {
                                minDistance = distance;
                                nearest = tmpShop;
                            }
                        });

                        showShopModal(nearest);
                    },
                    (error) => {
                        console.error("Ошибка получения координат: ", error);
                    }
                );
            }
        }
        else {
            getClosetShopBtn.remove();
        }

        const showShopModal = (shopData) => {
            if (shopData) {
                currentCityId = shopData.cityid;
                currentShopId = shopData.id;

                map.setLocation({
                    center: shopData.geo,
                    zoom: 16
                });

                document.querySelector("#shopModal-shopName").textContent = shopData.name;
                document.querySelector("#shopModal-shopAddress").textContent = shopData.address;

                const staticMap = "https://static-maps.yandex.ru/v1?ll=" + (shopData.geo[0]) + "," + (shopData.geo[1]) + "&lang=ru_RU&size=150,250&z=16&apikey=" + YAMAP_STATIC_APIKEY;
                document.querySelector("#shopModal-staticMap").src = staticMap;
                document.querySelector(".leo-shopListImages_map").href = 'https://yandex.ru/maps/?rtext=~' + shopData.geo.reverse().join(',') + '&z=16';

                const shopImages = document.querySelector('.leo-shopListImages');

                shopImages.querySelectorAll('.leo-shopListImages_image').forEach(oldImage => oldImage.remove());

                shopData.images.forEach(shopImage => {
                    const shopImageElement = document.createElement('img');
                    shopImageElement.className = 'leo-shopListImages_image';
                    shopImageElement.dataset.fancybox = "shopImages";
                    shopImageElement.src = shopImage;
                    shopImageElement.width = "160";
                    shopImageElement.height = "125";
                    shopImageElement.alt = "";
    
                    shopImages.appendChild(shopImageElement);
                });

                if (shopData.images.length == 0) {
                    for (let i = 0; i < 2; i++) {
                        const shopImageElement = document.createElement('img');
                        shopImageElement.className = 'leo-shopListImages_image';
                        shopImageElement.src = '/assets/images/empty_image.svg';
                        shopImageElement.width = "160";
                        shopImageElement.height = "125";
                        shopImageElement.alt = "";
        
                        shopImages.appendChild(shopImageElement);
                    }
                }
                else {
                    if (Fancybox) {
                        Fancybox.bind("[data-fancybox=\"shopImages\"]", {});
                    }
                }

                shopImages.scrollTo({
                    left: 0
                });

                const sheduleContainer = document.querySelector('.leo-shopModalShedule');
                sheduleContainer.innerHTML = '';
                const sheduleTitles = JSON.parse(document.querySelector('#shopShaduleTitles').textContent);
                Object.keys(shopData.shedule).forEach(key => {
                    const sheduleItem = document.createElement('p');
                    sheduleItem.className = 'leo-shopModalShedule_item';
                    sheduleItem.innerHTML = sheduleTitles[key] + ' – ' + (shopData.shedule[key] ? shopData.shedule[key] : sheduleTitles['Closed']);

                    sheduleContainer.appendChild(sheduleItem);
                });
                
                document.querySelector("#shopModalButton").textContent = shopData.isOpened == 1 ? sheduleTitles['Choose this store'] : sheduleTitles['Opening'];
                document.querySelector("#shopModalButton").disabled = shopData.isOpened == 0;
            }

            showModal('shopsDataModal');
        }

        document.querySelector('#shopModalButton').onclick = () => {
            let date = new Date();
            date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
            let expires = "expires=" + date.toUTCString();
            document.cookie = "cityid=" + currentCityId + ";" + expires + ";path=/";
            document.cookie = "shopid=" + currentShopId + ";" + expires + ";path=/";

            location.reload();
        }
    })();


    // Баннер на главной
    (function () {
        document.querySelectorAll('.leo-mainPageBanner').forEach(banner => {
            const indicators = banner.querySelectorAll('.leo-mainPageBannerIndicator_progress');
            const slides = banner.querySelectorAll('.leo-mainPageBanner_slide');

            if (!indicators) return;

            const time = 10;
            const slidesCount = indicators.length;
            let currentTime = 0;
            let currentSlide = 0;

            setInterval(() => {
                currentTime+=0.1;

                if (currentTime >= time) {
                    currentTime = 0;
                    currentSlide++;
                    
                    if (currentSlide >= slidesCount) {
                        currentSlide = 0;

                        indicators.forEach(indicator => {
                            indicator.style.maxWidth = '0px';
                        });
                    }

                    setSlide();
                }


                indicators[currentSlide].style.maxWidth = Math.round(currentTime / time * 100) + '%';
            }, 100);

            const setSlide = () => {
                const currentSlideElement = banner.querySelector('.leo-mainPageBanner_slide[style="display: block;"]');

                if (currentSlideElement) {
                    currentSlideElement.style.display = null;
                }

                slides[currentSlide].style.display = 'block';
            }

            banner.onclick = (e) => {

                if (e.target.classList.contains('leo-mainPageBanner_button')) return;

                if (banner.clientWidth / 5 > e.offsetX) {
                    currentSlide--;
                    if (currentSlide < 0) {
                        currentSlide = 0;
                        return;
                    }

                    indicators[currentSlide + 1].style.maxWidth = '0px';
                }
                else {
                    currentSlide++;
                    if (currentSlide >= slidesCount) {
                        currentSlide = slidesCount - 1;
                        return;
                    }

                    indicators[currentSlide - 1].style.maxWidth = '100%';
                }

                currentTime = 0;
                
                setSlide();
            }
        });
    })();

    // Переключатель в слайдере карточек
    (function () {
        document.querySelectorAll('.leo-cardsSlider').forEach(cardsSlider => {
            const controls = cardsSlider.querySelectorAll('.leo-cardsSlider_button');
            if (controls.length !== 2) return;

            const sliderArea = cardsSlider.children[1] ? cardsSlider.children[1] : null;
            if (!sliderArea) return;

            const slide = sliderArea.children[0] ? sliderArea.children[0] : null;
            if (!slide) return;

            const moveSlider = (direction = 1) => {
                sliderArea.scrollTo({
                    'left': sliderArea.scrollLeft + slide.clientWidth * direction,
                    'behavior': 'smooth'
                });
            }

            controls[0].onclick = () => moveSlider(-1);
            controls[1].onclick = () => moveSlider();
        });
    })();


    // Добавление товара в корзину
    (function () {
        document.querySelectorAll('.leo-goodCard_addBtn').forEach(addBtn => {
            const buttonsWrapper = addBtn.parentElement;
            if (!buttonsWrapper) return;

            const id = buttonsWrapper.dataset.id;
            if (!id) return;

            const counterButtons = buttonsWrapper.querySelectorAll('.leo-goodCard_counterButton');
            if (counterButtons.length !== 2) return;

            const counterInput = buttonsWrapper.querySelector('.leo-goodCard_counterInput input');
            if (!counterInput) return;

            addBtn.onclick = () => {
                addBtn.classList.add('leo-goodCard_addBtn__hidden');
                counterInput.value = 1;

                setTimeout(() => {
                    addBtn.style.display = 'none';
                }, 310);
            }

            counterButtons[0].onclick = () => {
                counterInput.value = parseInt(counterInput.value) - 1;

                if (counterInput.value == 0) {
                    addBtn.style.display = null;
                    
                    setTimeout(() => {
                        addBtn.classList.remove('leo-goodCard_addBtn__hidden');
                    }, 10);
                }
            }

            counterButtons[1].onclick = () => {
                counterInput.value = parseInt(counterInput.value) + 1;
            }

            counterInput.oninput = () => {
                if (counterInput.value < 1) {
                    counterInput.value = 0;
                    
                    addBtn.style.display = null;
                    
                    setTimeout(() => {
                        addBtn.classList.remove('leo-goodCard_addBtn__hidden');
                    }, 10);
                }
            }
        })
    })();

    // Поделиться
    (function () {
        document.querySelectorAll('.leo-shareBtn').forEach(shareBtn => {
            if (navigator.share) {
                shareBtn.onclick = async () => {
                    try {
                        await navigator.share({
                            title: document.title,
                            url: window.location.href
                        });
                    } catch (error) {
                        shareBtn.remove();
                    }
                }
            } else {
                shareBtn.remove();
            }
        })
    })();

    // Lazy loading
    (function () {
        let lazyImages = document.querySelectorAll('img[data-src]');
        if ('IntersectionObserver' in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.getAttribute('data-src');
                        lazyImage.removeAttribute('data-src');
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        } else {
            let lazyLoadThrottleTimeout;
            function lazyLoad() {
                if (lazyLoadThrottleTimeout) {
                    clearTimeout(lazyLoadThrottleTimeout);
                }

                lazyLoadThrottleTimeout = setTimeout(function() {
                    let scrollTop = window.pageYOffset;
                    lazyImages.forEach(function(img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.getAttribute('data-src');
                            img.removeAttribute('data-src');
                        }
                    });
                    if (lazyImages.length == 0) { 
                        document.removeEventListener("scroll", lazyLoad);
                        window.removeEventListener("resize", lazyLoad);
                        window.removeEventListener("orientationChange", lazyLoad);
                    }
                }, 20);
            }

            document.addEventListener("scroll", lazyLoad);
            window.addEventListener("resize", lazyLoad);
            window.addEventListener("orientationChange", lazyLoad);
        }
    })();


    // Галерея Fancybox
    (function(){
        if (Fancybox) {
            Fancybox.bind("[data-fancybox]", {});
        }
    })();
});