
module.exports = {
  purge: [],
  theme: {
    extend: {
      colors: {
        'myrtle-green': '#2B7A78',
        'Azure-x-11': '#DEF2F1',
        'navy-blue': '#0112FC',
        'snow-white': '#FFFBFC',
        'intl-orange-eng': '#BC2C1A',
        'baby-powder': '#FFFFFA',
        'light-grayish-blue': '#f2f4fa'
      }
    },
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'checked', 'active']
  },
  plugins: [],
}
