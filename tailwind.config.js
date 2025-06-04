/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
	content: ["./assets/**/*.{js,ts,scss}", "./**/*.php"],
	theme: {
		extend: {
			fontFamily: {
				sans: ["Inter", "sans-serif"],
			},
			boxShadow: {
				"header": `
          0px 50px 14px rgba(84, 84, 84, 0.00),
          0px 32px 13px rgba(84, 84, 84, 0.01),
          0px 18px 11px rgba(84, 84, 84, 0.02),
          0px 8px 8px rgba(84, 84, 84, 0.03),
          0px 2px 4px rgba(84, 84, 84, 0.04)
        `,
			},
			typography: (theme) => ({
				DEFAULT: {
					css: {
						color: theme("colors.gray.800"),
						fontFamily: theme("fontFamily.sans").join(", "),
					},
				},
			}),
		},
	},
	plugins: [require("@tailwindcss/typography")],
};
