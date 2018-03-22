!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

A visitor exit is a record of a person exiting from the premises.

## Visitor Exit Record

A visitor exit can be recorded using the `/v1/exit/` endpoint.  

## Request

Supply a GET request with the visitor ID and Authorization Header.

```
GET  /v1/exit/<visitor-ID>
Authorization: Token <access_token>
```  

## Method URL
`/v1/exit/`

## Required Parameters  
name | type | description
---- | ---- | -----------
visitor ID | string | Visitor ID of the visitor as specified above
**access_token** | string | The user's access token in the form of an Authorization header as specified above

## Response

The response generated will be in `JSON`.

### Sample Response
```json
{
  "success": true,
}
```

## Response Parameters
### Successful Request
name | type | description
---- | ---- | -----------
success | boolean | true - for successful request

### Bad Request
Please check [Errors and Exceptions](Errors-and-Exceptions.md) for a list of possible exceptions and errors.