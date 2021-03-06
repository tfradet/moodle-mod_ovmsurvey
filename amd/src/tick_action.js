define(['jquery', 'core/ajax', 'core/notification'],
function($, ajax, notification) {

    var TickAction = function(selector, status, surveyId, total) {
        this._region = $(selector);
        this._status = status;
        this._surveyid = surveyId;
        this._totalStmts = total;

        this._region.find('.ovm-option-list').unbind().on('click', 'button', this._setUserChoice.bind(this));
    };

    TickAction.prototype._setUserChoice = function(element) {
        var elem = $(element.target);
        var stmtid = elem.data('id');
        var value = elem.data('value');
        var status = this._status ? this._status : localStorage.getItem('ovms-status');

        if (stmtid != "" && value != "") {
            ajax.call([{
                methodname: 'mod_ovmsurvey_set_answer',
                args: {
                    surveyid: this._surveyid,
                    status: status ? status : '',
                    stmtid: stmtid,
                    value: value
                },
                done: function(data) {
                    $(element.target).parent().find('button').removeClass('active');
                    $(element.target).addClass('active');
                    $(element.target).parent().parent().parent().parent().parent().find('.check-svg').removeClass('hidden');

                    if (this._totalStmts == data) {
                        this.activeReviewButton();
                    }

                    return true;
                }.bind(this),
                fail: notification.exception
            }]);
        }
    };

    TickAction.prototype.activeReviewButton = function() {
        $('#ovmsurvey-review-button').removeClass("disabled");
        $('#ovmsurvey-review-link').removeClass("hidden");
    };

    return TickAction;
});