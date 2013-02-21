$(function() {
    $.fn.slenderSeason = function (params)
    {
        var defaults=
        {
            showId: null,
            classNumber: 1,
            type: 'episode',
            seasonClass: '.season',
            chngClass: '.season',
            parentSelector: '[name="parent_id"]',
            source: []
        };

        var options=$.extend(defaults, params);

        return this.each(function()
        {
            $this = $(this);

            var getSource = function() {
                if (options.showId) {
                    src = [];

                    $.ajax({
                        type: "GET",
                        url: "/api/" + options.type,
                        data: {action: 'getSeasons',param :options.showId},
                        dataType: "json"
                    }).success(function(res) {
                            $.each(res[options.type], function(index, value) {
                                src.push(value.season);
                            });
                        });

                    options.source = src;
                }
            };

            var initTypeahead = function(className) {
                $(className).typeahead({
                    source: options.source
                });
            };

            var updateSeasonInput = function() {
                var seasonInput = $(options.chngClass);
                seasonInput.removeClass(options.chngClass);
                options.chngClass = options.seasonClass + options.classNumber;
                options.classNumber++;
            };

            var initPage = function() {
                getSource();
                initTypeahead(options.seasonClass);
                initParent();
            };

            var initParent = function() {
                $(options.parentSelector).change(function(){
                    options.showId = $(options.parentSelector).val();
                    getSource();
                    updateSeasonInput();
                    initTypeahead(options.chngClass);
                });
            };

            initPage();
        });
    };
});