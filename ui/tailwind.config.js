/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        "principal": "#0DADAE",
        "gray": "#ebebeb",
        "white": "#FFFFFF",
        "dark": "#333",
        "mediun": "#999",
        "bar-orange": "#FBB03F",
      }
    },
  },
  plugins: [],
}

