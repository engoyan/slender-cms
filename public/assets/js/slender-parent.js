$(function() {
    $.fn.slenderParent = function (params)
    {
        var defaults=
        {
            parentTypeSelector: '#parent_type',
            parentErrorSelector: '#parent_error',
            parentIdSelector: '#parent_id',
            parentValueSelector: '#parent_value',
            parentRemoveSelector: '#parent_remove',
            parentSelectSelector: '#select_parent',
            modalSelector: '#myModal',

            parentTypeName: 'parent_type',
            ajaxUrl: '/api/',
            ajaxMethod: 'GET'

        };

        var options=$.extend(defaults, params);

        return this.each(function()
        {
            $this = $(this);

            var initTypeSelect = function() {
                $this.find(options.parentTypeSelector).on('change', function(){
                    $this.find(options.parentErrorSelector).hide();
                    $this.find("input[name='"+ $(this).attr('id') +"']").val($(this).val());

                    $.ajax({
                        type: options.ajaxMethod,
                        url: options.ajaxUrl + $(this).val(),
                        data: {action: 'all'},
                        dataType: "json"
                    }).done(function(res) {
                            var name = $this.find(options.parentTypeSelector).val().toLowerCase();
                            $.each(res[name], function(index, value) {
                                $this.find(options.parentIdSelector).append($("<option></option>")
                                    .attr("value",value.id)
                                    .text(value.title));
                            });
                        });
                });
            }

            var initParentId = function() {
                $this.find(options.parentIdSelector).on('change', function(){
                    $this.find(options.parentErrorSelector).hide();
                    $this.find("input[name='"+ $(this).attr('id') +"']").val($(this).val());
                    $this.find(options.parentValueSelector).html($this.find("input[name='"+options.parentTypeName+"']").val() + ": " + $this.find(options.parentIdSelector+" option:selected").text() );
                    $this.find(options.parentRemoveSelector).show();
                });
            }

            var initParentSelect = function() {
                $this.find(options.parentSelectSelector).on('click', function(){
                    if(!$this.find(options.parentIdSelector).val() || !$this.find(options.parentTypeSelector).val()){
                        $this.find(options.parentErrorSelector).show();
                        return false;
                    }
                    $this.find(options.modalSelector).modal('hide');
                    return false;
                });
            }

            var initRemoveParent = function() {
                $this.find(options.parentRemoveSelector).on('click', function(){
                    $this.find("input[name='parent_id']").val('');
                    $this.find("input[name='parent_type']").val('');
                    $this.find(options.parentValueSelector).html('');
                    $this.find(this).hide();
                    return false;
                });
            }

            initTypeSelect();
            initParentId();
            initParentSelect();
            initRemoveParent();
        });
    };
});