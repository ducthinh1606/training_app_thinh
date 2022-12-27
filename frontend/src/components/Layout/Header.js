import React from "react";
import "./Header.scss"

function Header() {
    return (
        <header className="App-header">
            <div className="header">
                <button className="user-dropdown">
                        <span><svg width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg"
                                   viewBox="0 0 512 512">
                            <path
                                d="M256 112c-48.6 0-88 39.4-88 88C168 248.6 207.4 288 256 288s88-39.4 88-88C344 151.4 304.6 112 256 112zM256 240c-22.06 0-40-17.95-40-40C216 177.9 233.9 160 256 160s40 17.94 40 40C296 222.1 278.1 240 256 240zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-46.73 0-89.76-15.68-124.5-41.79C148.8 389 182.4 368 220.2 368h71.69c37.75 0 71.31 21.01 88.68 54.21C345.8 448.3 302.7 464 256 464zM416.2 388.5C389.2 346.3 343.2 320 291.8 320H220.2c-51.36 0-97.35 26.25-124.4 68.48C65.96 352.5 48 306.3 48 256c0-114.7 93.31-208 208-208s208 93.31 208 208C464 306.3 446 352.5 416.2 388.5z"/>
                        </svg></span>
                    <span>Username</span>
                </button>
                <div className="dropdown-content">
                    <a href="#">Log out</a>
                </div>
            </div>
        </header>
    )
}

export default Header;