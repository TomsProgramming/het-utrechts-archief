<x-layout>
    <x-header />
    <main class="mt-20">
        <div id="panorama" class="h-[520px] relative overflow-hidden">
            <div id="panorama-content"
                class="h-[500px] w-full absolute top-0 left-0 cursor-grab [.grabbing]:cursor-grabbing">
                <div id="panorama-content-images">
                    @foreach ($images as $image)
                        <img class="absolute select-none pointer-events-none"
                            src="{{ asset('images/panorama/' . $image['image_path']) }}"
                            alt="Panorama Image {{ $loop->index + 1 }}"
                            style="height: {{ $image['height'] }}px; widht: {{ $image['width'] }}px; z-index: {{ $image['layer'] }}; left: {{ $image['x'] }}px; margin-top: {{ $image['y'] }}px;">
                    @endforeach
                </div>
            </div>
            <div id="hotspots">
                <div class=" absolute top-0 left-9 h-10 w-10 bg-red rounded-full">

                </div>
            </div>
        </div>
    </main>
    <x-footer />
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const panorama = document.querySelector('#panorama');
            const content = document.querySelector('#panorama-content');

            if (!panorama || !content) return;

            let scale = 1;
            const minScale = 1;
            const maxScale = 4;

            let posX = 0;
            let posY = 0;

            let isDragging = false;
            let startX = 0;
            let startY = 0;

            let isTouchZooming = false;
            let lastTouchDist = 0;

            const images = content.querySelectorAll('#panorama-content-images img');

            let minL = Infinity;
            let minT = Infinity;
            let maxR = -Infinity;
            let maxB = -Infinity;

            images.forEach(img => {
                const left = parseFloat(img.style.left) || img.offsetLeft || 0;
                const top = parseFloat(img.style.top) || img.offsetTop || 0;
                const width = parseFloat(img.style.width) || img.offsetWidth || img.naturalWidth || 0;
                const height = parseFloat(img.style.height) || img.offsetHeight || img.naturalHeight || 0;

                minL = Math.min(minL, left);
                minT = Math.min(minT, top);
                maxR = Math.max(maxR, left + width);
                maxB = Math.max(maxB, top + height);
            });

            if (!isFinite(minL)) {
                minL = 0;
                minT = 0;
                maxR = panorama.clientWidth;
                maxB = panorama.clientHeight;
            }

            function clampPosition() {
                const vw = panorama.clientWidth;
                const vh = panorama.clientHeight;

                const imgWidth = (maxR - minL) * scale;
                const imgHeight = (maxB - minT) * scale;

                if (imgWidth <= vw) {
                    posX = (vw - imgWidth) / 2 - minL * scale;
                } else {
                    const minPosX = vw - maxR * scale;
                    const maxPosX = -minL * scale;
                    posX = Math.min(Math.max(posX, minPosX), maxPosX);
                }

                if (imgHeight <= vh) {
                    posY = (vh - imgHeight) / 2 - minT * scale;
                } else {
                    const minPosY = vh - maxB * scale;
                    const maxPosY = -minT * scale;
                    posY = Math.min(Math.max(posY, minPosY), maxPosY);
                }
            }

            function updateTransform() {
                clampPosition();
                content.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
            }

            panorama.addEventListener('wheel', (e) => {
                e.preventDefault();

                const rect = panorama.getBoundingClientRect();
                const mouseX = e.clientX - rect.left;
                const mouseY = e.clientY - rect.top;

                const zoomSpeed = 0.1;
                const delta = e.deltaY > 0 ? -zoomSpeed : zoomSpeed;

                const prevScale = scale;
                let newScale = prevScale + delta;
                newScale = Math.max(minScale, Math.min(maxScale, newScale));

                if (newScale === prevScale) return;

                const xRel = (mouseX - posX) / prevScale;
                const yRel = (mouseY - posY) / prevScale;

                scale = newScale;
                posX = mouseX - xRel * scale;
                posY = mouseY - yRel * scale;

                updateTransform();
            }, {
                passive: false
            });

            panorama.addEventListener('mousedown', (e) => {
                isDragging = true;
                content.classList.add('dragging');
                startX = e.clientX - posX;
                startY = e.clientY - posY;
            });

            window.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                posX = e.clientX - startX;
                posY = e.clientY - startY;
                updateTransform();
            });

            window.addEventListener('mouseup', () => {
                isDragging = false;
                content.classList.remove('dragging');
            });

            function getTouchDistance(t1, t2) {
                const dx = t2.clientX - t1.clientX;
                const dy = t2.clientY - t1.clientY;
                return Math.sqrt(dx * dx + dy * dy);
            }

            panorama.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    isDragging = true;
                    isTouchZooming = false;
                    const t = e.touches[0];
                    startX = t.clientX - posX;
                    startY = t.clientY - posY;
                } else if (e.touches.length === 2) {
                    isDragging = false;
                    isTouchZooming = true;
                    lastTouchDist = getTouchDistance(e.touches[0], e.touches[1]);
                }
            }, {
                passive: false
            });

            panorama.addEventListener('touchmove', (e) => {
                if (e.touches.length === 1 && !isTouchZooming) {
                    e.preventDefault();
                    const t = e.touches[0];
                    posX = t.clientX - startX;
                    posY = t.clientY - startY;
                    updateTransform();
                } else if (e.touches.length === 2) {
                    e.preventDefault();

                    const t1 = e.touches[0];
                    const t2 = e.touches[1];
                    const rect = panorama.getBoundingClientRect();

                    const centerX = ((t1.clientX + t2.clientX) / 2) - rect.left;
                    const centerY = ((t1.clientY + t2.clientY) / 2) - rect.top;

                    const dist = getTouchDistance(t1, t2);
                    if (!lastTouchDist) lastTouchDist = dist;

                    const prevScale = scale;
                    let newScale = prevScale * (dist / lastTouchDist);
                    newScale = Math.max(minScale, Math.min(maxScale, newScale));

                    if (newScale !== prevScale) {
                        const xRel = (centerX - posX) / prevScale;
                        const yRel = (centerY - posY) / prevScale;

                        scale = newScale;
                        posX = centerX - xRel * scale;
                        posY = centerY - yRel * scale;

                        updateTransform();
                    }

                    lastTouchDist = dist;
                }
            }, {
                passive: false
            });

            panorama.addEventListener('touchend', (e) => {
                if (e.touches.length === 0) {
                    isDragging = false;
                    isTouchZooming = false;
                    lastTouchDist = 0;
                } else if (e.touches.length === 1) {
                    isTouchZooming = false;
                    const t = e.touches[0];
                    startX = t.clientX - posX;
                    startY = t.clientY - posY;
                }
            });

            updateTransform();
        });
    </script>

</x-layout>
