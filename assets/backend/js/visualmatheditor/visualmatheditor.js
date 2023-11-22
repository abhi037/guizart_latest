/*
VisualMathEditor, (x-mathjax-vme-public-config.js) 
Copyright © 2005-2013 David Grima, contact@equatheque.com under the terms of the GNU General Public License, version 3.
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses.
*/

MathJax.Hub.Config({
	showProcessingMessages: true,
	extensions: ['tex2jax.js','asciimath2jax.js',"mml2jax.js",'MathMenu.js','MathZoom.js','toMathML.js'],
	TeX: {
		extensions: ["autoload-all.js","noUndefined.js","AMSmath.js","AMSsymbols.js","AMScd.js","mhchem.js","enclose.js","cancel.js","color.js"],
		noUndefined: {
			attributes: {
				mathcolor: "#cc0000",
				mathbackground: "#ffff88",
				mathsize: "100%"
			}
		},
		equationNumbers: { autoNumber: "AMS" },
		Macros: {
		  binom: ["\\genfrac{(}{)}{0pt}{}{#1}{#2}",2],
		  abs: ["\\lvert #1 \\rvert",1],
		  norm: ["\\lVert #1 \\rVert",1],
		  braket: ["\\left\\langle #1 \\middle| #2 \\right\\rangle",2],
		  bra: ["\\left\\langle #1 \\right|",1],
		  ket: ["\\left| #1 \\right\\rangle",1],
		  Complex: "\\mathbb{C}",
		  Integer: "\\mathbb{Z}",
		  Rational: "\\mathbb{Q}",
		  Natural: "\\mathbb{N}",
		  Real: "\\mathbb{R}",
		  water: "\\ce{H2O}"
		}
	},
	jax: ['input/TeX','input/AsciiMath','input/MathML','output/SVG','output/HTML-CSS'], //'output/NativeMML'
	"HTML-CSS": {
		scale: 100,
		styles: {
		  ".MathJax .merror": {
			"background-color": "#FFFF88",
			color:   "#CC0000",
			border:  "1px solid #CC0000",
			padding: "1px 3px",
			"font-style": "normal",
			"font-size":  "50%"
		  }
		},
		imageFont:null
	},
	"SVG": {
		//mtextFontInherit: true, //nécessaire pour que les chiffres Arabe soient jolis mais mauvais pour l'exportation en SVG/PNG des formules chimiques... Mis en paramètre dans VME
		font: "TeX"
	},
	tex2jax: {
		inlineMath: [['$','$'],['\\(','\\)']],
		displayMath: [ ['$$','$$'], ['\\[','\\]'] ],
		processEscapes: true
	},
	asciimath2jax: {
		delimiters: [['`','`']]
	},
	menuSettings: {
		zoom: "none"
	},
	showMathMenu: true,
	showMathMenuMSIE: true,
	MathMenu: {
		showFontMenu: true,
		showRenderer: true
	}
});

//Set display style as the default style
MathJax.Hub.Register.StartupHook("TeX Jax Ready",function () {
	var TEX = MathJax.InputJax.TeX;
	var PREFILTER = TEX.prefilterMath;
	TEX.Augment({
			prefilterMath: function (math,displaymode,script) {
			math = "\\displaystyle{"+math+"}";
			return PREFILTER.call(TEX,math,displaymode,script);
		}
	});
});

MathJax.Ajax.loadComplete('http://visualmatheditor.equatheque.net/js/mathjax-MathEditorExtend/x-mathjax-vme-public-config.js');