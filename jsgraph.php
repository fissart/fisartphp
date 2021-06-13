<script type="text/javascript" src="jsxgraphcore.js"></script>
<link rel="stylesheet" type="text/css" href="jsxgraph.css" />

<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>

<script type="text/x-mathjax-config">
    MathJax.Hub.Config({TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>


<script type='text/javascript'>
JXG.Options.text.useMathJax = true;
JXG.Options.text.fontSize = 14;
JXG.Options = JXG.merge(JXG.Options, {
    showNavigation: false,
    point: {
        face: 'o',
        showInfobox: false,
        size: 1,
        color: '#000000'
    }
});
</script>







<!-- CSS only -->
<link rel="stylesheet" href="jsboots/bootstrap.min.css">
<link rel="stylesheet" href="jsboots/font-awesome.min.css">
<!-- JS, Popper.js, and jQuery -->
<script src="jsboots/jquery-3.2.1.js" crossorigin="anonymous"></script>
<script src="jsboots/bootstrap.bundle.js" crossorigin="anonymous"></script>
<script src="jsboots/bootstrap.js" crossorigin="anonymous"></script>

<script src='a076d05399.js'></script>




<!--
<iframe style="border:none;border-radius:30px 1px 30px 1px;width:95%;height:360px;display:block;margin:auto;" src="3/examples/webgl_points_dynamic.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/physics_ammo_break.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/my.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="untitled.html" seamless></iframe>
-->



<div class="container bg-info p-3">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="card text-center m-3 p-0 col-md-6 col-lg-4">

            <div class="card-header">wwwww</div>
            <div class="card-body text-center p-1">
                <div id="ww" class="jxgbox" style="width:350px; height:400px;margin:auto;"></div>
            </div>
            <div class="card-footer">ww</div>
        </div>

        <div class="card text-center m-3 p-0 col-md-6 col-lg-4">
            <div class="card-header">wwwww</div>

            <div class="card-body text-center p-1">
                <div id="hiperbola" class="jxgbox" style="width:350px; height:400px;margin:auto;"></div>
            </div>
            <div class="card-footer">ww</div>
        </div>

        <div class="card text-center m-3 p-0 col-md-6 col-lg-4">
            <div class="card-header">wwwww</div>
            <div class="card-body text-center p-1">
                <div id="wwwww" class="jxgbox" style="width:350px; height:400px;margin:auto;"></div>
            </div>
            <div class=" card-footer">ww</div>
        </div>
    </div>
</div>

<script type="text/javascript">
JXG.Options.axis.ticks.majorHeight = 60;
JXG.Options.axis.ticks.insertTicks = false;
JXG.Options.axis.ticks.ticksDistance = 100;
var board = JXG.JSXGraph.initBoard('ww', {
    keepAspectRatio: true,
    boundingbox: [-1, 8, 10, -2],
    axis: true,
    showFullscreen: true,
    zoom: {
        factorX: 1.25,
        factorY: 1.25,
        wheel: true,
        needshift: true,
        eps: 0.1
    },
    showNavigation: true,
    showCopyright: false,
    zoom: {
        wheel: true,
        enabled: true
    },
    pan: {
        needTwoFingers: false,
        enabled: false
    },
    defaultAxes: {
        y: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        },
        x: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        }
    },
});
ww1 = board.create("point", [2, -1], {
    name: "\\(F_1\\)",
    color: 'rgb(200,10,10)',
    label: {
        autoPosition: true,
        offset: [0, -20]
    }
});
ww2 = board.create("point", [8, 3], {
    name: "\\(F_2\\)",
    color: 'rgb(200,10,10)',
    label: {
        autoPosition: true,
        offset: [-5, -20]
    }
});
var l1w = board.create('line', [ww1, ww2], {
    strokeColor: 'green',
    strokewidth: 1
});
var mpw = board.create('midpoint', [ww1, ww2], {
    name: "\\(O\\)",
    label: {
        autoPosition: true,
        offset: [10, -10]
    }
});
var vecw = board.create('arrow', [
    [0, 0], mpw
], {
    strokeColor: 'black',
    lastArrow: {
        type: 2,
        size: 9
    },
    strokeWidth: 1,
    dash: 2
});
var perp1ww = board.create('perpendicular', [l1w, mpw], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});
eww = board.create("ellipse", [ww1, ww2, 9], {
    strokeColor: '#000000',
    strokewidth: 2
});
var b1ww = board.create('intersection', [eww, perp1ww, 0], {
    name: "\\(B_1\\)",
    label: {
        offset: [-15, -20]
    }
});
var b2ww = board.create('intersection', [eww, perp1ww, 1], {
    name: "\\(B_2\\)",
    label: {
        offset: [5, -20]
    }
});

var c1ww = board.create('intersection', [eww, l1w, 0], {
    name: "\\(V_1\\)",
    label: {
        offset: [15, -10]
    }
});
var c2ww = board.create('intersection', [eww, l1w, 1], {
    name: "\\(V_2\\)",
    label: {
        offset: [-30, 5]
    }
});

var s1w = board.create('segment', [b1ww, ww2], {
    straightFirst: true,
    straightLast: true,
    strokeWidth: 1,
    dash: 1
});

var s1ww = board.create('segment', [b1ww, b2ww], {
    strokeColor: 'green',
    strokewidth: 1
});

ewgw = board.create("glider", [2, 2, eww], {
    name: "\\(P\\)",
    color: 'rgb(200,10,10)',
    label: {
        position: "rt",
        offset: [-20, 20]
    }
});
c3ww = board.create('circle', [mpw, function() {
    return mpw.Dist(c1ww) * mpw.Dist(c1ww) / mpw.Dist(ww1)
}], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});
var d1w = board.create('intersection', [c3ww, l1w, 0], {
    name: ""
});
var d2w = board.create('intersection', [c3ww, l1w, 1], {
    name: ""
});
var perp2w = board.create('perpendicular', [l1w, d1w], {
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(\\mathcal{L}_1\\)',
    withLabel: true,
    label: {
        offset: [-30, 5],
        position: "lft"
    }
});
var perp3w = board.create('perpendicular', [l1w, d2w], {
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(\\mathcal{L}_1\\)',
    withLabel: true,
    label: {
        offset: [10, 10],
        position: "lft"
    }
});
var ww = board.create("tangent", [ewgw], {
    strokeColor: '#222200',
    strokewidth: 1
});
var pol2 = board.create('polygon', [ww1, ewgw, ww2], {
    hasInnerPoints: true
});
var t = board.create('text', [11, 0.2, function() {
    return pol2.Perimeter().toFixed(3);
}]);
</script>














<script type="text/javascript">
JXG.Options.axis.ticks.majorHeight = 60;
JXG.Options.axis.ticks.insertTicks = false;
JXG.Options.axis.ticks.ticksDistance = 100;
var board = JXG.JSXGraph.initBoard('hiperbola', {
    keepAspectRatio: true,
    boundingbox: [-1, 8, 11, -2],
    axis: true,
    showFullscreen: true,
    zoom: {
        factorX: 1.25,
        factorY: 1.25,
        wheel: true,
        needshift: true,
        eps: 0.1
    },
    showNavigation: true,
    showCopyright: false,
    zoom: {
        wheel: true,
        enabled: false
    },
    pan: {
        needTwoFingers: false,
        enabled: false
    },
    defaultAxes: {
        y: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        },
        x: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        }
    },
});

var gg = board.create("point", [2, -1], {
    name: "\\(F_1\\)",
    fillColor: '#306754',
    label: {
        autoPosition: true,
        offset: [0, -20]
    }
});
var g2 = board.create("point", [8, 3], {
    name: "\\(F_2\\)",
    label: {
        autoPosition: true,
        offset: [-5, 20]
    }
});

var line1 = board.create('line', [gg, g2], {
    strokeColor: 'green',
    strokewidth: 1
});
var mid1 = board.create('midpoint', [gg, g2], {
    name: "\\(O\\)",
    label: {
        autoPosition: true,
        offset: [0, -15]
    }
});
var vec = board.create('arrow', [
    [0, 0], mid1
], {
    strokeColor: 'black',
    lastArrow: {
        type: 2,
        size: 9
    },
    strokeWidth: 1,
    dash: 2
});
var perpend1 = board.create('perpendicular', [line1, mid1], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});


var hiper = board.create("hyperbola", [gg, g2, 5.5], {
    strokeColor: '#000000',
    strokewidth: 2
});

var tang = board.create("glider", [10.21, 1, hiper], {
    name: "\\(P\\)",
    label: {
        offset: [10, 10]
    }
});
board.create("tangent", [tang], {
    strokeColor: '#222200',
    strokewidth: 1
});

var pol2 = board.create('polygon', [gg, tang, g2], {
    hasInnerPoints: true
});


var circ1 = board.create('circle', [mid1, gg], {
    strokeColor: 'red',
    strokewidth: 1,
    dash: 1
});
//
var inte1 = board.create('intersection', [hiper, line1, 0], {
    name: "\\(V_1\\)",
    label: {
        offset: [15, -10]
    }
});
var inte2 = board.create('intersection', [hiper, line1, 1], {
    name: "\\(V_2\\)",
    label: {
        offset: [-30, 5]
    }
});

var perpen1 = board.create('perpendicular', [line1, inte1], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});
var perpen2 = board.create('perpendicular', [line1, inte2], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});

var r1 = board.create('intersection', [circ1, perpen1, 0], {
    name: "",
    label: {
        offset: [-15, -20]
    }
});
var r2 = board.create('intersection', [circ1, perpen1, 1], {
    name: "",
    label: {
        offset: [5, -20]
    }
});

var s1 = board.create('intersection', [circ1, perpen2, 0], {
    name: "",
    label: {
        offset: [-15, -20]
    }
});
var s2 = board.create('intersection', [circ1, perpen2, 1], {
    name: "",
    label: {
        offset: [5, -20]
    }
});
//
var int1 = board.create('intersection', [board.create('line', [r1, s1], {
    strokewidth: 0
}), perpend1, 0], {
    name: "\\(B_1\\)",
    label: {
        offset: [-15, -20]
    }
});
var int2 = board.create('intersection', [board.create('line', [r2, s2], {
    strokewidth: 0
}), perpend1, 1], {
    name: "\\(B_2\\)",
    label: {
        offset: [5, 30]
    }
});

var asintota1 = board.create('line', [s2, r1], {
    strokeColor: 'green',
    strokewidth: 1,
    dash: 1
});
var asintota1 = board.create('line', [s1, r2], {
    strokeColor: 'green',
    strokewidth: 1,
    dash: 1
});

var segment1 = board.create('segment', [s2, r2], {
    strokeColor: 'green',
    strokewidth: 1,
    dash: 1
});
var segment2 = board.create('segment', [s1, r1], {
    strokeColor: 'green',
    strokewidth: 1,
    dash: 1
});


var segmento1 = board.create('segment', [s1, s2], {
    strokeColor: 'green',
    strokewidth: 1
});
var segmento2 = board.create('segment', [r1, r2], {
    strokeColor: 'green',
    strokewidth: 1
});
var segmento1 = board.create('segment', [int1, int2], {
    strokeColor: 'green',
    strokewidth: 1,
    dash: 1
});

var recto1 = board.create('perpendicular', [line1, gg], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});
var recto2 = board.create('perpendicular', [line1, g2], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});

var recto_s = board.create('segment', [board.create('intersection', [hiper, recto1, 0], {
    name: ""
}), board.create('intersection', [hiper, recto1, 1], {
    name: ""
})], {
    strokeColor: 'green',
    strokewidth: 1
});
var recto_w = board.create('segment', [board.create('intersection', [hiper, recto2, 0], {
    name: ""
}), board.create('intersection', [hiper, recto2, 1], {
    name: ""
})], {
    strokeColor: 'green',
    strokewidth: 1
});

c3 = board.create('circle', [mid1, function() {
    return mid1.Dist(inte1) * mid1.Dist(inte1) / mid1.Dist(gg)
}], {
    highlight: false,
    strokeColor: 'red',
    strokewidth: 0
});


//var s1 = board.create('segment', [inte1, inte2], { strokeColor: 'green', strokewidth: 1 });
//var s1 = board.create('segment', [inte1, g2], { straightFirst: true, straightLast: true, strokeWidth: 1, dash: 1 });


var d1 = board.create('intersection', [c3, line1, 0], {
    name: ""
});
var d2 = board.create('intersection', [c3, line1, 1], {
    name: ""
});

board.create('perpendicular', [line1, d1], {
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(\\mathcal{L}_1\\)',
    withLabel: true,
    label: {
        offset: [-30, 5],
        position: "lft"
    }
});
board.create('perpendicular', [line1, d2], {
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(\\mathcal{L}_2\\)',
    withLabel: true,
    label: {
        offset: [10, 10],
        position: "lft"
    }
});

var t = board.create('text', [11, 0.2, function() {
    return pol2.Perimeter().toFixed(3);
}]);
</script>





















<script type="text/javascript">
JXG.Options.axis.ticks.majorHeight = 60;
JXG.Options.axis.ticks.insertTicks = false;
JXG.Options.axis.ticks.ticksDistance = 100;
var board = JXG.JSXGraph.initBoard('wwwww', {
    keepAspectRatio: true,
    boundingbox: [-1, 10, 10, -5],
    axis: true,
    showFullscreen: true,
    zoom: {
        factorX: 1.25,
        factorY: 1.25,
        wheel: true,
        needshift: true,
        eps: 0.1
    },
    showNavigation: true,
    showCopyright: false,
    zoom: {
        wheel: true,
        enabled: false
    },
    pan: {
        needTwoFingers: false,
        enabled: false
    },
    defaultAxes: {
        y: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        },
        x: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        }
    },
});


p1 = board.create("point", [2, 3.5], {
    name: "",
    fillColor: '#306754',
    label: {
        autoPosition: true,
        offset: [0, -20]
    }
});
p2 = board.create("point", [3, -2], {
    name: "",
    label: {
        autoPosition: true,
        offset: [-5, 20]
    }
});
f = board.create("point", [4.5, 0], {
    name: "\\(F\\)",
    label: {
        autoPosition: true,
        offset: [-10, -20]
    }
});

//p1.setProperty({snapToGrid: true,snapSizeX: 0.5});
//p2.setProperty({snapToGrid: true,snapSizeX: 0.5});
//f.setProperty({snapToGrid: true,snapSizeX: 0.5});

var l1 = board.create('line', [p1, p2], {
    strokeColor: 'green',
    strokewidth: 1
});
var ew = board.create('parabola', [f, l1], {
    strokeColor: '#000000',
    strokewidth: 2
});


ewg = board.create("glider", [6.5, 3.5, ew], {
    name: "\\(P\\)",
    label: {
        offset: [0, 20]
    }
});
//    ewg.setProperty({snapToGrid: true,snapSizeX: 0.5});
var w = board.create("tangent", [ewg], {
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(\\mathcal{L}_T\\)',
    withLabel: true,
    label: {
        offset: [10, -10],
        position: "lft"
    }
});

var l2 = board.create('perpendicular', [l1, f, 0], {
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(\\mathcal{L}_2\\)',
    withLabel: true,
    label: {
        offset: [-30, 5],
        position: "rt"
    }
});
var l3 = board.create('perpendicular', [l2, ewg, 0], {
    highlight: false,
    strokeColor: '#256552',
    strokewidth: 0,
    name: '',
    withLabel: true,
    label: {
        offset: [-30, 5],
        position: "rt"
    }
});
var ll = board.create('perpendicular', [l1, ewg, 0], {
    highlight: false,
    strokeColor: '#256552',
    strokewidth: 0,
    name: '',
    withLabel: true,
    label: {
        offset: [-30, 5],
        position: "rt"
    }
});
var lrecto = board.create('perpendicular', [l2, f], {
    highlight: false,
    strokeColor: '#256552',
    strokewidth: 0,
    name: '\\(\\mathcal{L}_2\\)',
    withLabel: true,
    label: {
        offset: [-30, 5],
        position: "rt"
    }
});

var c1 = board.create('intersection', [ew, lrecto, 0], {
    name: "\\(R_1\\)",
    label: {
        offset: [10, 0]
    }
});
var c2 = board.create('intersection', [ew, lrecto, 1], {
    name: "\\(R_2\\)",
    label: {
        offset: [10, 10]
    }
});



var recto = board.create('segment', [ewg, board.create('intersection', [l2, l3, 0], {
    highlight: false,
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(R\\)',
    label: {
        offset: [-30, 5]
    }
})], {
    strokeColor: 'green',
    strokewidth: 1,
    dash: 1
});
var recto2 = board.create('segment', [ewg, board.create('intersection', [l1, ll, 0], {
    highlight: false,
    strokeColor: '#256552',
    strokewidth: 1,
    name: '\\(R_1\\)',
    label: {
        offset: [-30, 5]
    }
})], {
    strokeColor: 'black',
    strokewidth: 1,
    dash: 1
});

//var recto3 = board.create('segment', [ewg,board.create('intersection', [l2, l3, 0],{highlight:false,strokeColor:'#256552',strokewidth:1,name:'\\(R_2ww\\)',label:{offset:[-30, 5]}})],{strokeColor:'black',strokewidth:1,dash:1});

var recto2 = board.create('segment', [c1, c2], {
    strokeColor: '#256552',
    strokewidth: 1,
    dash: 1
});
var recto2 = board.create('segment', [ewg, f], {
    strokeColor: '#256552',
    strokewidth: 1,
    dash: 1
});


var b1 = board.create('intersection', [ew, l2, 0], {
    name: "\\(V\\)",
    label: {
        offset: [-15, -20]
    }
});
var vec = board.create('arrow', [
    [0, 0], b1
], {
    strokeColor: 'black',
    lastArrow: {
        type: 2,
        size: 5
    },
    dash: 2
});

var b2 = board.create('intersection', [w, l2, 0], {
    name: "\\(S\\)",
    label: {
        offset: [-15, -20]
    }
});



var pol2 = board.create('polygon', [f, ewg, b2], {
    hasInnerPoints: true,
    dash: 1
});
</script>
















<h2>Distribucion normal (Estandarización)</h2>
<div class="container bg-primary p-3">
    <div id="new" class="jxgbox" style="width:1100px; height:500px;margin: auto;"></div>
</div>

<script>
JXG.Options.text.useMathJax = true;
var segArr = [],
    ptArr = [],
    bellArr = [];

var bellw = function(x) {
    return 1 / (s.Value() * Math.sqrt(2 * Math.PI)) * Math.exp(-1 * Math.pow((x - m.Value()), 2) / (2 * Math
        .pow(s.Value(), 2)));
};
var bellStandw = function(x) {
    return 1 / (Math.sqrt(2 * Math.PI)) * Math.exp(-1 * Math.pow((x), 2) / (2));
};

board = JXG.JSXGraph.initBoard("new", {
    showCopyright: false,
    showFullscreen: true,
    boundingbox: [-6.5, 1.35, 18, -0.5],
    zoom: {
        wheel: true,
        enabled: false
    },
    pan: {
        needTwoFingers: false,
        enabled: false
    },
});
var m = board.create('slider', [
    [4, 1],
    [15, 1],
    [0, 11, 20]
], {
    name: '',
    strokeColor: 'red',
    fillColor: 'white',
    size: 3,
    withTicks: false,
    withLabel: false
});
var s = board.create('slider', [
    [4, 1.2],
    [15, 1.2],
    [0.1, 2, 10]
], {
    name: '',
    strokeColor: 'black',
    fillColor: 'white',
    size: 3,
    withTicks: false,
    withLabel: false
});
m.baseline.setAttribute({
    strokeWidth: 2,
    strokeColor: 'rgb(255,0,100)',
    highlight: false,
    withTicks: false
});
m.highline.setAttribute({
    visible: false
});
s.baseline.setAttribute({
    strokeWidth: 2,
    strokeColor: 'rgb(255,0,100)',
    highlight: false,
    withTicks: false
});
s.highline.setAttribute({
    visible: false
});
var text1 = board.create("text", [function() {
    return m.X();
}, function() {
    return m.Y() - 0.1;
}, function() {
    return "\\(\\mu = " + m.X().toFixed(2) + '\\)'
}], {
    highlight: false
});
var text1 = board.create("text", [function() {
    return s.X();
}, function() {
    return s.Y() - 0.1;
}, function() {
    return "\\(\\sigma = " + s.X().toFixed(2) + '\\)'
}], {
    highlight: false
});



var l1 = board.create('segment', [
    [0, 0],
    [0, 0.7]
], {
    lastArrow: {
        type: 2,
        size: 6,
        highlightSize: 9
    },
    strokeWidth: 1.5,
    name: '\\(y\\)',
    withLabel: true,
    label: {
        offset: [10, -10],
        position: "rt"
    },
});
var l1 = board.create('line', [
    [0, 0],
    [0.6, 0]
], {
    lastArrow: {
        type: 2,
        size: 6,
        highlightSize: 9
    },
    strokeWidth: 1.5,
    name: '\\(x\\)',
    withLabel: true,
    label: {
        offset: [0, 15],
        position: "rt"
    },
});

var bellCurvew = board.create("functiongraph", [bellw, -20, 20], {
    strokeWidth: 2,
    highlight: false,
    strokeColor: '#306754'
});
var bellStandCurvew = board.create("functiongraph", [bellStandw, -20, 20], {
    strokeWidth: 2,
    highlight: false
});

var r = board.create('slider', [
    [-3, 0],
    [15, 0],
    [-3, 9.5, 15]
], {
    strokeColor: '#306754',
    fillColor: '#306754',
    size: 2,
    withTicks: false,
    withLabel: false
});
r.baseline.setAttribute({
    strokeWidth: 0,
    strokeColor: '#000',
    highlight: false
});
r.highline.setAttribute({
    visible: false
});


var u = board.create('slider', [
    [-3, 0],
    [15, 0],
    [-3, 12, 15]
], {
    strokeColor: '#306754',
    fillColor: '#306754',
    size: 2,
    withTicks: false,
    withLabel: false
});
u.baseline.setAttribute({
    strokeWidth: 0,
    strokeColor: '#000',
    highlight: false
});
u.highline.setAttribute({
    visible: false
});

var text1 = board.create("text", [function() {
    return u.X();
}, -0.1, function() {
    return "\\(x_2 = " + u.X().toFixed(2) + '\\)'
}], {
    highlight: false
});
var text2 = board.create("text", [function() {
    return r.X();
}, -0.1, function() {
    return "\\(x_1 = " + r.X().toFixed(2) + '\\)'
}], {
    highlight: false,
    label: {
        offset: [-30, 5],
        position: "top"
    }
});


var x1 = function() {
    return (r.Value() - m.Value()) / (s.Value())
};
var x2 = function() {
    return (u.Value() - m.Value()) / (s.Value())
};

var g1 = board.create("integral", [
    [function() {
        return r.X()
    }, function() {
        return u.X()
    }], bellCurvew
], {
    color: "#322132",
    fillOpacity: 0.5,
    withLabel: false
});
var g2 = board.create("integral", [
    [x1, x2], bellStandCurvew
], {
    color: "#77111177",
    fillOpacity: 0.5,
    withLabel: false
});


board.create('text', [-6, 1, function() {
    return "\\(z_1=\\frac{x_1 - \\mu}{\\sigma} = (" + r.Value().toFixed(2) + "-" + m.Value()
        .toFixed(
            2) + ")/" + (s.Value()).toFixed(2) + "=" + ((r.Value() - m.Value()) / (s.Value()))
        .toFixed(
            3) +
        '\\)'
}]);
board.create('text', [-6, 1.2, function() {
    return "\\(z_2=\\frac{x_1 - \\mu}{\\sigma} = (" + u.Value().toFixed(2) + "-" + m.Value()
        .toFixed(
            2) + ")/" + (s.Value()).toFixed(2) + "=" + ((u.Value() - m.Value()) / (s.Value()))
        .toFixed(
            3) +
        '\\)'
}]);

board.create("point", [function() {
    return r.Value()
}, function() {
    return bellw(r.Value())
}], {
    name: function() {
        return '\\(f(x_1)=' + bellw(r.Value()).toFixed(3) + '\\)'
    },
    label: {
        offset: [-120, 21]
    }
});
board.create("point", [function() {
    return u.Value()
}, function() {
    return bellw(u.Value())
}], {
    name: function() {
        return '\\(f(x_2)=' + bellw(u.Value()).toFixed(3) + '\\)'
    },
    label: {
        offset: [7, 21]
    }
});


board.create("point", [function() {
    return (r.Value() - m.Value()) / (s.Value())
}, function() {
    return bellStandw((r.Value() - m.Value()) / (s.Value()))
}], {
    name: function() {
        return '\\(z_1=' + bellStandw((r.Value() - m.Value()) / (s.Value())).toFixed(3) + '\\)'
    },
    label: {
        offset: [-90, 21]
    }
});
board.create("point", [function() {
    return (u.Value() - m.Value()) / (s.Value())
}, function() {
    return bellStandw((u.Value() - m.Value()) / (s.Value()))
}], {
    name: function() {
        return '\\(z_2=' + bellStandw((u.Value() - m.Value()) / (s.Value())).toFixed(3) + '\\)'
    },
    label: {
        offset: [7, 21]
    }
});

board.create('text', [2, -0.3, function() {
    return '\\(\\displaystyle\\int_{z_1}^{z_2}\\frac{1}{\\sqrt{2\\pi\\sigma^2}}e^{-\\frac{1}{2\\sigma^2}\\left(x-\\mu\\right)^2}= \\int_{x_1}^{x_2}\\frac{1}{\\sqrt{2\\pi}}e^{-\\frac{1}{2}\\left(x\\right)^2} =  ' +
        JXG.toFixed(g2.Value(), 3) + '\\)'
}], {
    highlight: false
});

var s11 = board.create("point", [function() {
    return s.Value() + m.Value()
}, 0], {
    visible: false,
    name: 'e'
});
var s12 = board.create("point", [function() {
    return s.Value() + m.Value()
}, function() {
    return bellw(s.Value() + m.Value())
}], {
    visible: TRUE,
    name: 'ee'
});
board.create("segment", [s11, s12], {
    strokeWidth: 1,
    dash: 2,
    color: "#8C201A",
    fixed: true
});

var s21 = board.create("point", [function() {
    return -1 * s.Value() + m.Value()
}, 0], {
    visible: false,
    name: 'e'
});
var s22 = board.create("point", [function() {
    return -1 * s.Value() + m.Value()
}, function() {
    return bellw(-1 * s.Value() + m.Value())
}], {
    visible: true,
    name: 'ee'
});
board.create("segment", [s21, s22], {
    strokeWidth: 1,
    dash: 2,
    color: "#8C201A",
    fixed: true
});
</script>









$$
\frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}=0.2575257$$





<h2>Distribucion lambda (Estandarización)</h2>

$$\left(2\pi\sigma^2\right)^{-\frac{1}{2}}\exp\left\{-\frac{1}{2\sigma^2}\left(x-\mu\right)^2\right\}$$
<div class="container bg-primary p-3">
    <div id="new2" class="jxgbox" style="width:100%; height:450px;margin: auto;"></div>
</div>

<script>
JXG.Options.text.useMathJax = true;
board = JXG.JSXGraph.initBoard("new2", {
    showNavigation: false,
    showCopyright: false,
    boundingbox: [-6.5, 1, 18, -0.5],
    axis: true,
    zoom: {
        wheel: true,
        enabled: false
    },
    pan: {
        needTwoFingers: false,
        enabled: false
    }
});
var segArr = [],
    ptArr = [],
    bellArr = [];

var t1 = board.create('slider', [
    [4, 0.5],
    [15, 0.5],
    [0, 4, 20]
], {
    name: '\\(r\\)',
    strokeColor: '#125',
    fillColor: 'white',
    size: 3,
    withTicks: false
});
var w1 = board.create('slider', [
    [4, 0.6],
    [15, 0.6],
    [0.1, 2, 10]
], {
    name: '\\(\\lambda\\)',
    strokeColor: 'black',
    fillColor: 'white',
    size: 3,
    withTicks: false
});
var f1 = function(x) {
    return Math.pow(x, t1.Value() - 1) * Math.exp(-x);
};

var f1c = board.create("functiongraph", [f1, -20, 20], {
    strokeWidth: 2,
    highlight: false,
    strokeColor: '#306754'
});

var gamma = board.create("integral", [
    [0, 100], f1c
], {
    color: "rgb(0,0,200)",
    fillOpacity: 0.5,
    withLabel: false
});

var f2 = function(x) {
    return w1.Value() / Math.pow(Math.PI, 0.5) * Math.pow(w1.Value() * x, 0.5) * Math.exp(-w1.Value() * x);
};
var f2c = board.create("functiongraph", [f2, -20, 20], {
    strokeWidth: 2,
    highlight: false,
    strokeColor: '#3067'
});

var gamma = board.create("integral", [
    [0.5, 10], f2c
], {
    color: "rgb(0,0,200)",
    fillOpacity: 0.5,
    withLabel: false
});


board.create('text', [1, -0.2, function() {
    return '\\(\\displaystyle\\int_{z_1}^{z_2}\\frac{1}{\\sqrt{2\\pi\\sigma^2}}e^{-\\frac{1}{2\\sigma^2}\\left(x-\\mu\\right)^2}= \\int_{x_1}^{x_2}\\frac{1}{\\sqrt{2\\pi}}e^{-\\frac{1}{2}\\left(x\\right)^2} = ' +
        gamma.Value().toFixed(3) + '\\)'
}], {
    highlight: false
});


//varianzas lineas
//rho
//var s11=board.create("point", [function(){ return s.Value() + m.Value()}, 0], { visible: false, name: 'e' });
//var	s12=board.create("point", [function(){ return s.Value() + m.Value()}, function(){ return bellw(s.Value() + m.Value())}], { visible:false, name: 'ee' });
//board.create("segment", [s11, s12], { strokeWidth: 1, dash: 1, color: "#8C201A", fixed: true });

//var s21=board.create("point", [function(){ return -1*s.Value() + m.Value()}, 0], { visible: false, name: 'e' });
//var	s22=board.create("point", [function(){ return -1*s.Value() + m.Value()}, function(){ return bellw(-1*s.Value() + m.Value())}], { visible:false, name: 'ee' });
//board.create("segment", [s21, s22], { strokeWidth: 1, dash: 1, color: "#8C201A", fixed: true });
//2rho
//var s31=board.create("point", [function(){ return 2*s.Value() + m.Value()}, 0], { visible: false, name: 'e' });
//var	s32=board.create("point", [function(){ return 2*s.Value() + m.Value()}, function(){ return bellw(2*s.Value() + m.Value())}], { visible:false, name: 'ee' });
//board.create("segment", [s31, s32], { strokeWidth: 1, dash: 1, color: "#8C201A", fixed: true });

//var s41=board.create("point", [function(){ return -2*s.Value() + m.Value()}, 0], { visible: false, name: 'e' });
//var	s42=board.create("point", [function(){ return -2*s.Value() + m.Value()}, function(){ return bellw(-2*s.Value() + m.Value())}], { visible:false, name: 'ee' });
//board.create("segment", [s41, s42], { strokeWidth: 1, dash: 1, color: "#8C201A", fixed: true });
//3rho
//var s51=board.create("point", [function(){ return 0*s.Value() + m.Value()}, 0], { visible: false, name: 'e' });
//var	s52=board.create("point", [function(){ return 0*s.Value() + m.Value()}, function(){ return bellw(0*s.Value() + m.Value())}], { visible:false, name: 'ee' });
//board.create("segment", [s51, s52], { strokeWidth: 1, dash: 1, color: "#8C201A", fixed: true });
</script>









<style>
.ww7 {
    width: 100%;
    height: 300px;
    margin: auto;

    position: relative;
    overflow: hidden;
    background-color: rgb(255, 255, 255);
    border-width: 1px;
    border-radius: 10px;
    -webkit-border-radius: 5px;
    -ms-touch-action: none;
    /* touch-action: none; */
    /* Set with JavaScript */
}

@media screen and (max-width:800px) {
    .ww7 {
        width: 100%;
        height: 100%;
        margin: auto;
    }


}
</style>

<div class="container bg-primary p-3">
    <div id="ww7" class="ww7"></div>
</div>


<script type='text/javascript'>
JXG.Options.text.useMathJax = true;
var b1 = JXG.JSXGraph.initBoard('ww7', {
    keepAspectRatio: true,
    boundingbox: [-10, 8, 10, -8],
    axis: true,
    showFullscreen: true,
    zoom: {
        wheel: true,
        enabled: false
    },
    pan: {
        needTwoFingers: false,
        enabled: false
    },
    showNavigation: true,
    showCopyright: false,
    defaultAxes: {
        y: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        },
        x: {
            ticks: {
                visible: true,
                majorHeight: 5
            }
        }
    },
});

b1.suspendUpdate();
var a = b1.create('slider', [
    [-5, -2],
    [5, -2],
    [-5, -2, 5]
], {
    name: '\\(a\\)',
    size: 3,
    snapWidth: 0.1
});
var b = b1.create('slider', [
    [-5, -3],
    [5, -3],
    [-5, 0, 5]
], {
    name: '\\(b\\)',
    size: 3,
    snapWidth: 0.1
});
var c = b1.create('slider', [
    [-5, -4],
    [5, -4],
    [-5, 0, 5]
], {
    name: '\\(a\\)',
    size: 3,
    snapWidth: 0.1
});
var d = b1.create('slider', [
    [-5, -5],
    [5, -5],
    [-5, 0.5, 5]
], {
    name: '\\(d\\)',
    size: 3,
    snapWidth: 0.1
});

var v = b1.create('point', [2, 2], {
    face: 'o',
    size: 0.5,
    name: '\\(v\\)',
    label: {
        autoPosition: true,
        offset: [0, -20]
    }
});
var va = b1.create('arrow', [
    [0, 0], v
], {
    lastArrow: {
        type: 2,
        size: 6,
        highlightSize: 9
    },
    strokeWidth: 2,
    name: '\\(x\\)'
});

var v2 = b1.create('point', [
    function() {
        return a.Value() * v.X() + b.Value() * v.Y();
    },
    function() {
        return c.Value() * v.X() + d.Value() * v.Y();
    }
], {
    face: 'o',
    size: 2,
    name: "\\(v\\)'",
    fillColor: 'black',
    strokeColor: 'black',
    label: {
        autoPosition: true,
        offset: [0, -20]
    }
});
var va2 = b1.create('arrow', [
    [0, 0], v2
], {
    strokeColor: 'black',
    strokeWidth: 3,
    lastArrow: {
        type: 2,
        size: 6,
        highlightSize: 9
    }
});

var t = b1.create('text', [-8, 5, function() {
    return '\\[ M = \\left(\\begin{matrix}' + (a.Value()).toFixed(2) + '&' + (b.Value()).toFixed(
            2) +
        '\\\\' + (c.Value()).toFixed(2) + '&' +
        (d.Value()).toFixed(2) + '\\end{matrix}\\right)\\]';
}]);
b1.unsuspendUpdate();
var t2 = b1.create('text', [8, 5,
    function() {
        return "\\[\\lambda = \\frac{|v'|}{|v|} = " +
            (
                JXG.Math.Geometry.distance([0, 0], [v2.X(), v2.Y()]) /
                JXG.Math.Geometry.distance([0, 0], [v.X(), v.Y()])
            ).toFixed(3) +
            "\\]";
    }
]);


showTrace = false;
var toggleTrace = function() {
    showTrace = !showTrace;
    v.setProperty({
        trace: showTrace
    });
    v2.setProperty({
        trace: showTrace
    });
    var b = document.getElementById("toggleButton");
    if (showTrace) {
        b.value = "Hide trace";
    } else {
        b.value = "Show trace";
        v.clearTrace();
        v2.clearTrace();
    }
};
</script>