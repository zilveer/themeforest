var Models = window.Models || {};
jQuery.noConflict();

Models.Grid = function(w, h, el) {

    this.width = w;
    this.height = h;
    this.blocks = [];
    this.field = new Models.Block(w, h, 0, 0);
    this.element = el;

    this.place = function(block, x, y, html, creationIndex) {
        block.setPosition(x, y);

        return this._induct(block);
    };

    this.add = function(block) {
        var grid = this;
        var opening = _(this.field.units()).detect(function(unit) {
            return grid.canFit(block, unit.x, unit.y);
        });

        return this._induct(block);
    };

    this._induct = function(block) {
        if (this.canFit(block)) {
            this.blocks.push(block);
            this.renderChild(block);

            if (this.isComplete()) {
                this.element.trigger('complete');
            }

            return this;
        }

        return false;
    };

    this.removeBlockWithIndex = function(blockIndex) {
        if (this.blocks.length == 1) {
            _(this.blocks).each(function(block) {
                block.destroy();
            });

            this.blocks = [];
            return this;
        }
        var indexToRemove = false;
        var cIndex = 0;
        _(this.blocks).each(function(block) {
            if (block.creationIndex == blockIndex) {
                indexToRemove = cIndex;
                block.destroy();
            }
            cIndex++;
        });

        if (indexToRemove !== false) {
            this.blocks.splice(indexToRemove, 1);
        }

        return this;
    };

    this.clear = function() {
        _(this.blocks).each(function(block) {
            block.destroy();
        });

        this.blocks = [];
        return this;
    };

    this.canFit = function(block, blockX, blockY) {
        block.setPosition(blockX, blockY);

        for (var i = 0; i < this.blocks.length; i++) {
            if (this.blocks[i].overlapsAny(block)) {
                return false;
            }
        }

        return block.overlappedFullyBy(this.field);
    };

    this.blockAtPosition = function(unit) {
        var testBlock = new Models.Block(1, 1, unit.x, unit.y);

        return _(this.blocks).detect(function(block) {
            return block.overlapsAny(testBlock);
        });
    };

    this.blocksOverlappedByBlock = function(overlapper) {
        var grid = this;
        return _(this.blocks).select(function(block) {
            return block.overlapsAny(overlapper);
        });
    };

    this.isComplete = function() {
        var gridUnitCount = this.field.units().length;
        var blockUnitCount = _.reduce(this.blocks, function(memo, block) {
            return memo + block.units().length;
        }, 0);

        return gridUnitCount == blockUnitCount;
    };

    this.render = function() {
        if (_(this.element).isUndefined()) {
            this.element = jQuery(document.createElement('div')).addClass('grid');

            _.each(this.blocks, function(block) {
                this.renderChild(block);
            }, this);
        }

        return this.element;
    };

    this.renderChild = function(block) {
        this.render();
        this.element.append(block.render());
    };
};