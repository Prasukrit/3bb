;(function($)
{
    $.fn.checkAll = function (options)
    {
        var options = $.extend({
                scope: 'form',
                onMasterClick: null,
                onScopeChange: null
            }, options);

        return this.each(function() {

            var $master_checkbox = $(this),
                $scope = options.scope instanceof jQuery ? options.scope : $master_checkbox.closest(options.scope);

            $master_checkbox.on('click', function(e) {

                if ($master_checkbox.is(':checked'))
                    $scope.find('input[type="checkbox"]').not($master_checkbox).prop('checked', true).trigger('change');
                else
                    $scope.find('input[type="checkbox"]').not($master_checkbox).prop('checked', false).trigger('change');

                if (typeof options.onMasterClick === 'function')
                        options.onMasterClick($master_checkbox, $scope);
            });

            $scope.on('change', 'input[type="checkbox"]', function(e) {

                var $changed_checkbox = $(this);

                if ($changed_checkbox.is($master_checkbox))
                    return;

                if (typeof options.onScopeChange === 'function')
                        options.onScopeChange($master_checkbox, $changed_checkbox, $scope);

                if ( ! $changed_checkbox.is(':checked')) {
                    $master_checkbox.prop('checked', false);
                    return;
                }

                if ($scope.find('input[type="checkbox"]').not($master_checkbox).not(':checked').length === 0)
                    $master_checkbox.prop('checked', true);
                
            });
        });
    };
    
}(jQuery));
