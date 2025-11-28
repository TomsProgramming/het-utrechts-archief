<x-layout>
    <header class="w-full bg-white fixed top-0 z-998 select-none">
        <div class="flex flex-row items-center justify-around pt-5">
            <button class="h-full bg-light-green">
                <i class="fa-solid fa-magnifying-glass text-white text-3xl p-3.5"></i>
            </button>

            <nav class="flex flex-row space-x-4">
                <div class="group nav-item">
                    <i class="fa-solid fa-chevron-right text-base font-bold group-[.open]:rotate-90"></i>
                    <span>Onderzoek</span>

                    <div class="nav-sub-container">
                        <a href="#">Collecties</a>
                        <a href="#">Zoek op onderwerp</a>
                        <a href="#">Studiezaal</a>
                        <a href="#">Bouwdossiers</a>
                        <a href="#">Archiefstuk inzien</a>
                        <a href="#">Verzoek tot digitaliseren</a>
                        <a href="#">Helpt u mee?</a>
                        <a href="#">Open data</a>
                        <a href="#">Openbaarheid</a>
                    </div>
                </div>
                <div class="group nav-item">
                    <i class="fa-solid fa-chevron-right text-base font-bold group-[.open]:rotate-90"></i>
                    <span>Ontdekken</span>

                    <div class="nav-sub-container">
                        <a href="#">Tentoonstellingen</a>
                        <a href="#">Activiteiten</a>
                        <a href="#">Families en kinderen</a>
                        <a href="#">Plan je bezoek</a>
                        <a href="#">Rondleidingen</a>
                        <a href="#">Verhalen</a>
                        <a href="#">Podcasts</a>
                        <a href="#">Utrecht Time Machine</a>
                    </div>
                </div>
                <div class="group nav-item">
                    <i class="fa-solid fa-chevron-right text-base font-bold group-[.open]:rotate-90"></i>
                    <span>Onderwijs</span>

                    <div class="nav-sub-container">
                        <a href="#">Primair onderwijs</a>
                        <a href="#">Voortgezet onderwijs</a>
                        <a href="#">Taalklassen aanbod</a>
                        <a href="#">Studenten</a>
                        <a href="#">Cursussen</a>
                        <a href="#">Voorwaarden Groepsbezoek</a>
                    </div>
                </div>
                <div class="group nav-item">
                    <i class="fa-solid fa-chevron-right text-base font-bold group-[.open]:rotate-90"></i>
                    <span>Vakgenoten</span>

                    <div class="nav-sub-container">
                        <a href="#">e-depot</a>
                        <a href="#">Archiefbeheer</a>
                        <a href="#">Toezicht</a>
                        <a href="#">Toezicht in de praktijk</a>
                    </div>
                </div>
                <div class="group nav-item">
                    <i class="fa-solid fa-chevron-right text-base font-bold group-[.open]:rotate-90"></i>
                    <span>Over ons</span>

                    <div class="nav-sub-container">
                        <a href="#">Archief overdragen</a>
                        <a href="#">Beleid</a>
                        <a href="#">Projecten</a>
                        <a href="#">Nieuws</a>
                        <a href="#">Medewerkers</a>
                        <a href="#">Vacatures</a>
                        <a href="#">Word vriend</a>
                        <a href="#">Toegankelijkheid</a>
                        <a href="#">Heeft u een klacht?</a>
                    </div>
                </div>
                <div class="group nav-item">
                    <span>Contact</span>
                </div>
            </nav>

            <div class="bg-red">
                <img src="/images/logo.svg">
            </div>
        </div>
    </header>
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
        </div>
    </main>
    <footer class="py-12 w-full bg-white">
        <div class="grid grid-cols-3 w-[60%] mx-auto">
            <div class="flex flex-col w-[90%]">
                <p class="mb-5">Plan een bezoek</p>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Expo - Hamburgerstraat 28</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Studiezaal - Alexander Numankade 199 - 201</span>
                </a>

                <p class="my-5">Onderzoek</p>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Archieven doorzoeken</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Beeldmateriaal bekijken</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Bouwtekeningen </span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Personen zoeken</span>
                </a>
            </div>
            <div class="flex flex-col w-[90%]">
                <p class="mb-5">Over ons</p>

                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Nieuws</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Agenda</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Uw materiaal in ons archief</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Contact</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Toegankelijkheid</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Auteursrecht en disclaimer</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>Privacyverklaring</span>
                </a>
                <a class="font-bold space-x-2" href="#">
                    <i class="fa-solid fa-chevron-right text-red text-lg"></i>
                    <span>ANBI</span>
                </a>
            </div>
            <div class="flex flex-col">
                <p class="mb-5">Contact</p>
                <p class="space-x-3 font-bold"><i class="fa-solid fa-phone text-2xl text-red"></i><span>(030) 286 66
                        11</span></p>
                <p class="space-x-3 font-bold"><span
                        class="text-2xl text-red">@</span><span>inlichtingen@hetutrechtsarchief.nl</span></p>
                <p class="space-x-3 font-bold"><i class="fa-solid fa-envelope text-2xl text-red"></i><span>Postadres:
                        Postbus 131, 3500 AC Utrecht</span></p>
                <p class="space-x-3 font-bold"><i class="fa-regular fa-message text-2xl text-red"></i><span>Chat: di
                        t/m do 9.00 - 13.00 uur</span></p>

                <p class="my-5">Volg ons op</p>
                <div class="flex flex-row">
                    <a href="#"><i class="fa-brands fa-facebook-f p-3 text-2xl text-red"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram p-3 text-2xl text-red"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube p-3 text-2xl text-red"></i></a>
                </div>
            </div>
        </div>
        <div class="w-[60%] mx-auto mt-5">
            <div class="text-2xl">
                <p>Blijf op de hoogte van het laatste nieuws</p>
                <div class="grid grid-cols-4 mt-6">
                    <form class="col-start-1 col-end-3 grid grid-cols-3">
                        <div class="col-start-1 col-end-3">
                            <label for="email"
                                class="block w-full text-base border-b-2 border-gray-300">E-mailadres</label>
                            <input type="email" name="email"
                                class="w-full p-3 outline-0 focus:border-2 focus:border-gray-300">
                        </div>
                        <button type="submit" class="bg-red text-white p-3 mt-6 text-lg font-bold">Verstuur</button>
                    </form>
                    <div class="col-start-5">
                        <p class="text-base">IBAN: NL66RABO0123881641</p>
                        <p class="text-base">KvK: 62047302</p>
                        <p class="text-base">BTW: NL807024594B01</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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

            // Touch variables
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

            // ---------- MUIS ZOOM NAAR CURSOR ----------
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

                // Punt onder de muis vasthouden
                const xRel = (mouseX - posX) / prevScale;
                const yRel = (mouseY - posY) / prevScale;

                scale = newScale;
                posX = mouseX - xRel * scale;
                posY = mouseY - yRel * scale;

                updateTransform();
            }, {
                passive: false
            });

            // ---------- MUIS DRAG ----------
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

            // ---------- TOUCH EVENTS (iPad / mobiel) ----------
            function getTouchDistance(t1, t2) {
                const dx = t2.clientX - t1.clientX;
                const dy = t2.clientY - t1.clientY;
                return Math.sqrt(dx * dx + dy * dy);
            }

            panorama.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    // 1 vinger: drag
                    isDragging = true;
                    isTouchZooming = false;
                    const t = e.touches[0];
                    startX = t.clientX - posX;
                    startY = t.clientY - posY;
                } else if (e.touches.length === 2) {
                    // 2 vingers: pinch zoom
                    isDragging = false;
                    isTouchZooming = true;
                    lastTouchDist = getTouchDistance(e.touches[0], e.touches[1]);
                }
            }, {
                passive: false
            });

            panorama.addEventListener('touchmove', (e) => {
                if (e.touches.length === 1 && !isTouchZooming) {
                    // pannen met 1 vinger
                    e.preventDefault();
                    const t = e.touches[0];
                    posX = t.clientX - startX;
                    posY = t.clientY - startY;
                    updateTransform();
                } else if (e.touches.length === 2) {
                    // pinch-zoom met 2 vingers rond het midden
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
                    // terug naar drag-modus met 1 vinger
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
