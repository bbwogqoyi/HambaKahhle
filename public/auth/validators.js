
var inputValidator = {
  'getElementById': function(id) {
    var domElemn = document.getElementById(id);
    return {
      '_node': domElemn,
      '_isValidationValid': true, 
      '_colors': null,
      'setColors': function(ok, c) {
        this.colors = {
          'ok': ok,
          'error': error,
        }
      },
      'getState': function() {
        return this._isValidationValid;
      },
      'isNotEmptyOrWhitespace': function() {
        var value = 
          this._node.value == null || 
          this._node.value == undefined || 
          String.prototype.trim(this._node.value).length === 0;
        this._setState(!value);
        return this;
      },
      'exactNumberOfDigits': function(count) {
        var isNumber = 
          !(this._node.value == undefined || 
          String.prototype.trim(this._node.value).length === 0) && 
          !isNaN(this._node.value);
        var isInRange = this._node.value.length===count;
        this._setState(isNumber && isInRange);
        return this;
      },
      'matchingValue': function(value) {
        var matching = 
          !(this._node.value == undefined || 
          String.prototype.trim(this._node.value).length === 0) && 
          this._node.value === value;
          this._setState(matching);
          return this;
      },
      'predicate': function(fn) {
        var value = this._node.value || '';
        var verdict = fn.call(value);
        this._setState(verdict);
        return this;
      },
      'extensionFormat': function(value) {
        var hasPrefix = value[0] === 'x' | value[0] === 'X';
        var extNumber = value.substring(1);
        var isInRange = extNumber.length >= 3 && extNumber.length <= 4;
        var isNumber = !isNaN(extNumber);
        this._setState(hasPrefix && isInRange && isNumber);
        return this;
      },
      'emailFormat': function() {
        var isEmail = 
          this.isNotEmptyOrWhitespace() && 
          (this._node.value.indexOf("@") !== -1)
        this._setState(isEmail);
        return this;
      }, 
      '_setState': function(flag) {
        this._isValidationValid = flag;
        this._node.style.borderColor = this._isValidationValid ? '#e2e8f0': '#f56565';
      }
    }
  }
}
