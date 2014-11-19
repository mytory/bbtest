var Breakdown = Backbone.Model.extend({
    defaults: {
        id: null,
        content: '',
        category: '',
        amount: 0,
        date: moment().format('YYYY-MM-DD')
    },
    initialize: function () {},
    url: 'action.php',
    validate: function (attrs) {
        _.forEach(attrs, function (value, key) {
            if (key == 'id') {
                return true;
            }
            if (!value) {
                return 'no ' + key + '!';
            }
        })
    }
});

var BreakdownForm = Backbone.View.extend({
    el: '.bb-breakdown-form',
    model: new Breakdown(),
    events: {
        'submit': 'submit'
    },
    submit: function(e){
        e.preventDefault();
        this.model.set($(this.el).serializeObject());
        if(this.model.get('id') == ''){
            this.model.set('id', null);
        }
        var result = this.model.save();
        var that = this;
        result.done(function(data){
            that.model.set(data);

        });
    }
});

var Moneybook = Backbone.Collection.extend({
    model: Breakdown,
    url: 'action.php'
});

var BreakdownListView = Backbone.View.extend({

    el: '.bb-breakdown-collection',

    initialize:function () {
        var that = this;
        this.model = new Moneybook();
        this.model.bind("add", function (breakdown) {
            that.$el.append(new BreakdownListItem({model:breakdown}).render().el);
        });
        this.model.fetch();
        return this;
    }
});

var BreakdownListItem = Backbone.View.extend({
    tagName: 'li',
    className: 'bb-breakdown',
    render: function(){
        var compile = _.template($('.template-breakdown').html());
        this.el = compile(this.model.attributes);
        return this;
    }
});

window.breakdownForm = new BreakdownForm();
window.breakdownListView = new BreakdownListView()
