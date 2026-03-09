(() => {
  const blocked = [
    // Gallery “b” images
    "A-GAL6b.webp","A-GAL8b.webp","A-GAL13b.webp","A-GAL14b.webp",
    "A-GAL17b.webp","A-GAL18b.webp","A-GAL19b.webp","A-GAL20b.webp","A-GAL21b.webp",

    // Product image families (matches any size/version like -650x650, -scaled, .webp, etc.)
    "ABCA-H",
    "AC-H",
    "ACON-H",
    "ACT-H",
    "ADAC-H",
    "ALC-H",
    "AOT-H",
    "AREDT-H",
    "ARODT-H",
    "AS-H"
  ];

  function pickSrcFrom(el) {
    if (!el) return "";
    const img = (el.tagName === 'IMG') ? el : (el.closest?.('img') || el.querySelector?.('img'));
    return img ? (img.currentSrc || img.src || '') : '';
  }

  function isBlocked(target) {
    const src = pickSrcFrom(target);
    return blocked.some(f => src.includes(f));
  }

  document.addEventListener("contextmenu", (e) => {
    if (isBlocked(e.target)) e.preventDefault();
  }, true);

  document.addEventListener("dragstart", (e) => {
    if (isBlocked(e.target)) e.preventDefault();
  }, true);
})();