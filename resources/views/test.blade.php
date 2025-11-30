<x-layout>
    <main>
        <div class="flex gap-6">
            <!-- HOOFD PANORAMA -->
            <div id="panorama" class="h-[260px] w-[600px] relative overflow-hidden bg-[#f7ead7] rounded-2xl shadow-md">
                <!-- Panorama content -->
                <div id="panorama-content"
                    class="h-[210px] w-full absolute top-0 left-0 cursor-grab [.grabbing]:cursor-grabbing overflow-hidden">
                    <div id="panorama-content-images" class="h-full w-max flex">
                        <!-- JOUW PANORAMA IMAGES / DIVS HIER -->
                        <img src="/images/panorama/1.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/2.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/3.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/4.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/5.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/6.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/7.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                        <img src="/images/panorama/8.jpg" alt="Panorama"
                            class="h-full w-auto select-none pointer-events-none" />
                    </div>
                </div>

                <!-- Slider onderin (zoals eerder) -->
                <div class="absolute bottom-4 left-0 w-full flex justify-center">
                    <div id="panorama-minimap"
                        class="relative w-[80%] h-[6px] rounded-full bg-[#d0b998] cursor-pointer">
                        <div
                            class="absolute left-[3px] right-[3px] top-1/2 -translate-y-1/2 h-[2px] rounded-full bg-[#f4e5cf]/80">
                        </div>

                        <div id="panorama-minimap-thumb"
                            class="absolute -top-[5px] h-[16px] w-[16px] rounded-full bg-[#8b4a3a] shadow-md"></div>
                    </div>
                </div>
            </div>

            <!-- RECHTER MINI MAP -->
            <div id="panorama-mini-wrapper" class="w-[260px] h-[260px] bg-[#f6e6cc] rounded-3xl shadow-lg relative">

                <!-- Klein label / tab bovenin -->
                <div class="absolute inset-x-0 top-0 flex justify-center mt-2">
                    <div
                        class="px-3 py-1 text-[10px] tracking-[0.25em] uppercase
                    bg-[#fdf5e8] rounded-full border border-[#e3cda8]
                    text-[#b58b55] shadow-sm">
                        Mini map
                    </div>
                </div>

                <!-- Binnenkader met de mini-panorama -->
                <div id="panorama-mini-inner"
                    class="absolute inset-7 mt-2 bg-[#fdf5e8] rounded-2xl
                overflow-hidden border border-[#e6d2aa]">

                    <!-- Verkleinde content -->
                    <div id="panorama-mini-content" class="origin-top-left">
                        <!-- Zelfde images als in je hoofd-panorama -->
                        <div class="h-[210px] w-max flex">
                            <img src="/images/panorama/1.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/2.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/3.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/4.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/5.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/6.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/7.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                            <img src="/images/panorama/8.jpg" alt="Panorama mini"
                                class="h-full w-auto select-none pointer-events-none" />
                        </div>
                    </div>

                    <!-- Viewport-kader -->
                    <div id="panorama-mini-viewport"
                        class="absolute border border-white/80 bg-white/10
                    rounded-[3px] pointer-events-none shadow-sm">
                    </div>
                </div>
            </div>

        </div>



    </main>
    <script>
        const panorama = document.getElementById('panorama');
        const contentWrapper = document.getElementById('panorama-content');
        const content = document.getElementById('panorama-content-images');

        const minimap = document.getElementById('panorama-minimap');
        const thumb = document.getElementById('panorama-minimap-thumb');

        const miniWrapper = document.getElementById('panorama-mini-wrapper');
        const miniInner = document.getElementById('panorama-mini-inner');
        const miniContent = document.getElementById('panorama-mini-content');
        const miniViewport = document.getElementById('panorama-mini-viewport');

        // Hoeveel hoofd-viewport-breedtes passen er in de mini map?
        // Groter getal = verder uitgezoomd (meer tegelijk zien, kleiner detail).
        const ZOOM_FACTOR = 3;

        let offsetX = 0;
        let isDraggingPanorama = false;
        let startX = 0;
        let startOffsetX = 0;

        let minimapScale = 1;

        function clamp(v, min, max) {
            return Math.max(min, Math.min(max, v));
        }

        function getSizes() {
            return {
                contentWidth: content.scrollWidth,
                viewportWidth: panorama.clientWidth,
                viewportHeight: contentWrapper.clientHeight
            };
        }

        function applyOffset() {
            content.style.transform = `translateX(${-offsetX}px)`;
        }

        // Slider onder de panorama
        function updateThumb() {
            const {
                contentWidth,
                viewportWidth
            } = getSizes();
            const minimapWidth = minimap.clientWidth;

            if (contentWidth <= viewportWidth) {
                thumb.style.display = 'none';
                return;
            }
            thumb.style.display = 'block';

            const maxOffset = contentWidth - viewportWidth;
            const thumbWidth = thumb.clientWidth;
            const maxLeft = minimapWidth - thumbWidth;
            const ratio = offsetX / maxOffset;

            thumb.style.left = (ratio * maxLeft) + 'px';
        }

        // Schalen + croppen van de mini-panorama
        function updateMiniScaleAndPosition() {
            const {
                contentWidth
            } = getSizes();
            if (!contentWidth) return;

            const innerRect = miniInner.getBoundingClientRect();
            const innerWidth = innerRect.width;

            // We willen ongeveer (contentWidth / ZOOM_FACTOR) in beeld
            // => schaal groter dan "alles passend in beeld".
            minimapScale = (ZOOM_FACTOR * innerWidth) / contentWidth;

            miniContent.style.transformOrigin = 'top left';

            // Verschoven op basis van offsetX, zodat mini hetzelfde stuk laat zien
            const tx = -offsetX * minimapScale;
            miniContent.style.transform = `translateX(${tx}px) scale(${minimapScale})`;
        }

        // Kader dat het zichtbare deel aangeeft
        function updateMiniViewport() {
            const {
                viewportWidth,
                viewportHeight
            } = getSizes();

            const innerRect = miniInner.getBoundingClientRect();
            const innerLeft = 0; // binnen miniInner zelf
            const innerTop = 0;

            miniViewport.style.width = (viewportWidth * minimapScale) + 'px';
            miniViewport.style.height = (viewportHeight * minimapScale) + 'px';
            miniViewport.style.left = innerLeft + 'px';
            miniViewport.style.top = innerTop + 'px';
        }

        function fullUpdate() {
            applyOffset();
            updateThumb();
            updateMiniScaleAndPosition();
            updateMiniViewport();
        }

        // ---- Panorama drag ----
        contentWrapper.addEventListener('mousedown', (e) => {
            isDraggingPanorama = true;
            startX = e.clientX;
            startOffsetX = offsetX;
            document.documentElement.classList.add('grabbing');
            e.preventDefault();
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDraggingPanorama) return;

            const {
                contentWidth,
                viewportWidth
            } = getSizes();
            if (contentWidth <= viewportWidth) return;

            const maxOffset = contentWidth - viewportWidth;
            const deltaX = e.clientX - startX;

            offsetX = clamp(startOffsetX - deltaX, 0, maxOffset);
            fullUpdate();
        });

        window.addEventListener('mouseup', () => {
            if (isDraggingPanorama) {
                isDraggingPanorama = false;
                document.documentElement.classList.remove('grabbing');
            }
        });

        // ---- Klikken op slider-balk ----
        minimap.addEventListener('click', (e) => {
            if (e.target === thumb) return;

            const rect = minimap.getBoundingClientRect();
            const x = e.clientX - rect.left;

            const {
                contentWidth,
                viewportWidth
            } = getSizes();
            if (contentWidth <= viewportWidth) return;

            const minimapWidth = minimap.clientWidth;
            const thumbWidth = thumb.clientWidth;
            const maxOffset = contentWidth - viewportWidth;
            const maxLeft = minimapWidth - thumbWidth;

            const targetLeft = clamp(x - thumbWidth / 2, 0, maxLeft);
            const ratio = targetLeft / maxLeft;

            offsetX = ratio * maxOffset;
            fullUpdate();
        });

        // ---- Thumb drag ----
        let isDraggingThumb = false;
        let thumbStartX = 0;
        let thumbStartLeft = 0;

        thumb.addEventListener('mousedown', (e) => {
            isDraggingThumb = true;
            thumbStartX = e.clientX;
            thumbStartLeft = parseFloat(getComputedStyle(thumb).left);
            e.stopPropagation();
            e.preventDefault();
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDraggingThumb) return;

            const {
                contentWidth,
                viewportWidth
            } = getSizes();
            if (contentWidth <= viewportWidth) return;

            const minimapWidth = minimap.clientWidth;
            const thumbWidth = thumb.clientWidth;
            const maxLeft = minimapWidth - thumbWidth;
            const maxOffset = contentWidth - viewportWidth;

            const deltaX = e.clientX - thumbStartX;
            const newLeft = clamp(thumbStartLeft + deltaX, 0, maxLeft);
            const ratio = newLeft / maxLeft;

            offsetX = ratio * maxOffset;
            fullUpdate();
        });

        window.addEventListener('mouseup', () => {
            isDraggingThumb = false;
        });

        // ---- Klikken in de mini map om te springen ----
        miniInner.addEventListener('click', (e) => {
            // niet reageren als je precies op het viewport-kader klikt
            if (e.target === miniViewport) return;

            const rect = miniInner.getBoundingClientRect();
            const x = e.clientX - rect.left;

            const {
                contentWidth,
                viewportWidth
            } = getSizes();
            const maxOffset = contentWidth - viewportWidth;

            const innerWidth = rect.width;

            // relatief over de volledige panorama (0..1)
            const ratio = x / innerWidth;
            offsetX = clamp(ratio * maxOffset, 0, maxOffset);
            fullUpdate();
        });

        // Init
        window.addEventListener('load', fullUpdate);
        window.addEventListener('resize', fullUpdate);
    </script>



</x-layout>
