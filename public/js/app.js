/**
 *
 * @author Alexandre Thebaldi <ahlechandre@gmail.com>
 */
(() => {
  /**
   * Request API.
   *
   * @return {object}
   */
  const request = () => (
    {
      /**
       * @param {string} url
       * @param {string} body
       * @param {function} thenCallback
       * @return {undefined}
       */
      send: (url, header, thenCallback) => (
        fetch(url, header)
          .then(response => response.json())
          .then(thenCallback)
      ),
    }
  )

  /**
   * Destroy news module.
   *
   * @return {object}
   */
  const destroyNews = () => {
    /**
     * @return {HTMLElement|null}
     */
    const validate = () => document.querySelector('form[name="form-news-destroy"]')

    /**
     * @return {HTMLElement|null}
     */
    const getButtonSubmit = () => (document.querySelector('button[type="submit"][name="submit-destroy"]'))

    /**
     * @return {string}
     */
    const getHeaderUrl = () => (
      window.location.href
    )

    /**
     * @param {string} headerLocation
     */
    const redirectClient = headerLocation => (
      window.location.href = headerLocation
    )

    const getHeader = () => ({
      method: 'delete',
    })

    /**
     * @return {undefined}
     */
    const init = () => (
      getButtonSubmit() ?
        getButtonSubmit().addEventListener('click', (event) => {
          event.preventDefault()
          request().send(
            getHeaderUrl(),
            getHeader(),
            result => (
              result.success && result.location ? redirectClient(result.location) : true
            )
          )
        }) :
        undefined
    )

    return {
      init,
      validate,
    }
  };

  /**
   * Update news module.
   *
   * @return {object}
   */
  const updateNews = () => {
    /**
     * @return {HTMLElement|null}
     */
    const validate = () => document.querySelector('form[name="form-news-edit"]')

    /**
     * @return {HTMLElement|null}
     */
    const getButtonSubmit = () => (document.querySelector('button[type="submit"][name="submit-update"]'))

    /**
     * @return {array}
     */
    const getFields = () => ([
      document.querySelector('input[id="news-title"]'),
      document.querySelector('textarea[id="news-content"]'),
    ])

    /**
     * @param {array} fields
     * @returns {string}
     */
    const getHeaderBody = (fields) => {
      const values = fields.reduce((prev, curr, index, arr) => {
        const result = prev
        result[arr[index].name] = arr[index].value
        return result
      }, {})

      return encodeURIComponent(JSON.stringify(values))
    }

    /**
     * @return {string}
     */
    const getHeaderUrl = () => (
      window.location.href
    )

    /**
     * @param {string} headerLocation
     */
    const redirectClient = headerLocation => (
      window.location.href = headerLocation
    )

    const getHeader = body => ({
      method: 'post',
      headers: {
        'Content-Type': 'application/json',
      },
      body: `json=${body}`,
    })

    /**
     * @return {undefined}
     */
    const init = () => (
      getButtonSubmit() ?
        getButtonSubmit().addEventListener('click', (event) => {
          event.preventDefault()
          request().send(
            getHeaderUrl(),
            getHeader(getHeaderBody(getFields())),
            result => (
              result.success && result.location ? redirectClient(result.location) : true
            )
          )
        }) :
        undefined
    )

    return {
      init,
      validate,
    }
  };

  /**
   * Loads all modules passed as argument.
   *
   * @param {array} _modules
   */
  const loadModules = _modules => (
    _modules.forEach(_module => (
      _module().validate() ? _module().init() : false
    ))
  )

  window.addEventListener('load', () => loadModules([updateNews, destroyNews]));
})()
