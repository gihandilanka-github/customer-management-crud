
export default ({ app }, inject) => {
    const constant = {
        CURRENCY_LABEL: 'Rs',

    }

    inject('constant', constant)
}
