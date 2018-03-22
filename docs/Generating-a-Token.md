!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

An access token is an opaque string that identifies a user, and can be used by the app to make API calls. The reply includes information about when the token will expire.  

A client needs to obtain an Access Token in order to request information and communicate with the server. This access token is issued upon a successful login by the user, and expires every 30 days, after which, the user must authenticate again.  

## Generating Access Tokens
## Request

To generate an app access token, you need to make a API call to the `/v1/oauth/` endpoint:  
```
POST /v1/oauth/
     ?username={username}
     &password={password}
     [&device-info={device-info}
     &debug={value}]
```  

## Method URL
`/v1/oauth/` 

!!! note
    Due to the how XAMPP Apache is configured, `POST` requests will be discarded if the trailing slash (`/`) is not added in the end of the URL. Please make sure to either use a trailing slash, or supply the request to `/v1/add/index.php`

## Required Parameters  
name | type | description
---- | ---- | -----------
username | string | Username of the user
password | string | Password of the user


## Optional Parameters  
name | type | description
---- | ---- | -----------
device-info | string | Information of the device (Max length - 200)
debug | int | See below for valid values

### debug
!!! note
    Will be only available in `Development` branch.

- 0 = Disable debug mode (default)
- 1 = Enable debug mode

## Response

The response generated will be in `JSON`.

### Sample Response
```json
{
  "success": true,
  "data": {
    "access_token": "6a9382f695dc36f38e46dc08726fc8a3a22a270f",
    "expiry": 1501257349
  }
}
```
## Response Parameters
### Successful Request
name | type | description
---- | ---- | -----------
success | boolean | true - for successful request
**data** | **JSON Obejct**| **Contains token information which may include the following:**
access_token | string | Actual token. Used to send requests
expiry | int | Expiry time of token (UNIX Timestamp)

### Bad Request
name | type | description
---- | ---- | -----------
success | boolean | false - for unsuccessful request
**errors** | **JSON Object** | **Contains error information (see error documentation)**

OAuth errors in the `errors` object are documented in [Errors and Exceptions](Errors-and-Exceptions.md).

### Debug Mode Enabled
name | type | description
---- | ---- | -----------
**debug** | **JSON Object** | **Contains debugging data which may include the following:**
mysql | string | Returns the MYSQL error when query fails
username | string | Username not found
password | string | Password incorrect

!!! note
    Returned only with debug mode enabled.

## Best Practices

* **Supplying Device Information**: It is recommended that the client supplies device information, so that sessions can be identified easily. Not doing so will default device info to `Unknown`, and may lead to deauthorization the device.