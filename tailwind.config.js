module.exports = {
  content: [
    "./templates/**/*.html.twig", // Scanne les fichiers Twig pour les classes Tailwind
    "./assets/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        receipt: ["Courier New", "monospace"], // Typo style ticket de caisse
      },
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["light"], // Utilise un thème clair de base
  },
};