(function () {
    function createStageTarget () {
        return {
            isStage: true,
            name: 'Stage',
            visible: true,
            x: 0,
            y: 0,
            size: 100,
            direction: 90,
            draggable: false,
            rotationStyle: 'all around',
            currentCostume: 0,
            costumes: [],
            sounds: [],
            blocks: {},
            variables: {},
            lists: {},
            broadcasts: {},
            comments: {}
        };
    }

    function createSpriteTarget (name) {
        return {
            isStage: false,
            name: name || 'Kedi',
            visible: true,
            x: 0,
            y: 0,
            size: 100,
            direction: 90,
            draggable: false,
            rotationStyle: 'all around',
            currentCostume: 0,
            costumes: [],
            sounds: [],
            blocks: {},
            variables: {},
            lists: {},
            broadcasts: {},
            comments: {}
        };
    }

    function normalizeProject (project) {
        var normalized = project;

        if (typeof project === 'string') {
            try {
                normalized = JSON.parse(project);
            } catch (error) {
                normalized = {};
            }
        }

        if (!normalized || typeof normalized !== 'object') {
            normalized = {};
        }

        if (!Array.isArray(normalized.targets)) {
            normalized.targets = [];
        }

        if (!normalized.monitors) {
            normalized.monitors = [];
        }

        if (!normalized.extensions) {
            normalized.extensions = [];
        }

        var hasStage = normalized.targets.some(function (target) {
            return target && target.isStage;
        });

        if (!hasStage) {
            var existingSprite = normalized.targets.find(function (target) {
                return target && !target.isStage;
            });
            var stageTarget = createStageTarget();
            var spriteTarget = existingSprite || createSpriteTarget('Kedi');
            normalized.targets = [stageTarget, spriteTarget];
        }

        return normalized;
    }

    function patchVm (vm) {
        if (!vm || vm.__scratcheditorPatched) {
            return;
        }

        var originalLoadProject = vm.loadProject && vm.loadProject.bind(vm);
        if (!originalLoadProject) {
            return;
        }

        vm.loadProject = function (project) {
            return originalLoadProject(normalizeProject(project));
        };

        vm.__scratcheditorPatched = true;
    }

    function interceptWindowVmAssignment () {
        try {
            var currentVm = window.vm;
        } catch (e) {
            currentVm = undefined;
        }

        var internalVm = currentVm;

        try {
            Object.defineProperty(window, 'vm', {
                configurable: true,
                enumerable: true,
                get: function () {
                    return internalVm;
                },
                set: function (v) {
                    internalVm = v;
                    try { patchVm(internalVm); } catch (e) { console.warn('patchVm failed', e); }
                }
            });
        } catch (e) {
            // If defineProperty fails, fallback to polling
            window.setInterval(function () {
                var vm = window.vm || (window.gui && window.gui.vm);
                if (vm) {
                    patchVm(vm);
                }
            }, 250);
            return;
        }

        // If there is currently a vm, patch it immediately
        if (internalVm) {
            patchVm(internalVm);
        }

        // Also intercept window.gui assignment so we can patch gui.vm later
        try {
            var currentGui = window.gui;
            var internalGui = currentGui;
            Object.defineProperty(window, 'gui', {
                configurable: true,
                enumerable: true,
                get: function () { return internalGui; },
                set: function (g) {
                    internalGui = g;
                    try {
                        if (g && Object.prototype.hasOwnProperty.call(g, 'vm')) {
                            try { patchVm(g.vm); } catch (e) { console.warn('patchVm failed on gui.vm', e); }
                        }

                        // ensure future assignments to gui.vm get patched
                        try {
                            Object.defineProperty(internalGui, 'vm', {
                                configurable: true,
                                enumerable: true,
                                get: function () { return g && g.vm; },
                                set: function (val) { if (g) { g.vm = val; } try { patchVm(val); } catch (e) { /* ignore */ } }
                            });
                        } catch (e) {
                            // ignore
                        }
                    } catch (e) {
                        console.warn('Error handling gui set', e);
                    }
                }
            });

            if (internalGui && internalGui.vm) {
                patchVm(internalGui.vm);
            }
        } catch (e) {
            // ignore
        }

        // Fallback: ensure loadProject is patched if vm exists later
        window.setInterval(function () {
            var vm = window.vm || (window.gui && window.gui.vm);
            if (vm) patchVm(vm);
        }, 500);
    }

    // Install interception immediately
    try { interceptWindowVmAssignment(); } catch (e) { setTimeout(interceptWindowVmAssignment, 250); }
})();
